<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface NotesContract
{
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
    ): BlockedCustomerNote;

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
    ): BlockedCustomerNote;
}
