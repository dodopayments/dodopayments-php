<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Blocklist\Customers;

use Dodopayments\Blocklist\Customers\Notes\BlockedCustomerNote;
use Dodopayments\Blocklist\Customers\Notes\NoteCreateParams;
use Dodopayments\Blocklist\Customers\Notes\NoteUpdateParams;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface NotesRawContract
{
    /**
     * @api
     *
     * @param string $entryID Blocklist entry id
     * @param array<string,mixed>|NoteCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $noteID Path param: Note id
     * @param array<string,mixed>|NoteUpdateParams $params
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
    ): BaseResponse;
}
