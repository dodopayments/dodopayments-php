<?php

declare(strict_types=1);

namespace Dodopayments\Services\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Blocklist\Customers\NotesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class NotesService implements NotesContract
{
    /**
     * @api
     */
    public NotesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NotesRawService($client);
    }

    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $entryID,
        string $note,
        RequestOptions|array|null $requestOptions = null,
    ): BlockedCustomerNote {
        $params = Util::removeNulls(['note' => $note]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($entryID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $noteID Path param: Note id
     * @param string $entryID Path param: Blocklist entry id
     * @param string $note Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $noteID,
        string $entryID,
        string $note,
        RequestOptions|array|null $requestOptions = null,
    ): BlockedCustomerNote {
        $params = Util::removeNulls(['entryID' => $entryID, 'note' => $note]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($noteID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
