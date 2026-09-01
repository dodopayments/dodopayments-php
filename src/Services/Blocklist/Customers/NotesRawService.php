<?php

declare(strict_types=1);

namespace Dodopayments\Services\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Blocklist\Customers\Notes\NoteCreateParams;
use Dodopayments\Blocklist\Customers\Notes\NoteUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Blocklist\Customers\NotesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class NotesRawService implements NotesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param array{note: string}|NoteCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BlockedCustomerNote>
     *
     * @throws APIException
     */
    public function create(
        string $entryID,
        array|NoteCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NoteCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['blocklist/customers/%1$s/notes', $entryID],
            body: (object) $parsed,
            options: $options,
            convert: BlockedCustomerNote::class,
        );
    }

    /**
     * @api
     *
     * @param string $noteID Path param: Note id
     * @param array{entryID: string, note: string}|NoteUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BlockedCustomerNote>
     *
     * @throws APIException
     */
    public function update(
        string $noteID,
        array|NoteUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NoteUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $entryID = $parsed['entryID'];
        unset($parsed['entryID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['blocklist/customers/%1$s/notes/%2$s', $entryID, $noteID],
            body: (object) array_diff_key($parsed, array_flip(['entryID'])),
            options: $options,
            convert: BlockedCustomerNote::class,
        );
    }
}
