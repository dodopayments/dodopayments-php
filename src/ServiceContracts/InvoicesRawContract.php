<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Invoices\Invoice;
use Dodopayments\Invoices\InvoiceAddNoteParams;
use Dodopayments\Invoices\InvoiceCreateParams;
use Dodopayments\Invoices\InvoiceDeleteParams;
use Dodopayments\Invoices\InvoiceFinalizeParams;
use Dodopayments\Invoices\InvoiceListEventsResponse;
use Dodopayments\Invoices\InvoiceListParams;
use Dodopayments\Invoices\InvoiceMarkUncollectableParams;
use Dodopayments\Invoices\InvoiceNewHostedLinkResponse;
use Dodopayments\Invoices\InvoicePreviewExistingParams;
use Dodopayments\Invoices\InvoicePreviewParams;
use Dodopayments\Invoices\InvoiceRetryParams;
use Dodopayments\Invoices\InvoiceSendParams;
use Dodopayments\Invoices\InvoiceUpdateDunningParams;
use Dodopayments\Invoices\InvoiceUpdateParams;
use Dodopayments\Invoices\InvoiceVoidParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface InvoicesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|InvoiceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function create(
        array|InvoiceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function retrieve(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array<string,mixed>|InvoiceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function update(
        string $invoiceID,
        array|InvoiceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InvoiceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Invoice>>
     *
     * @throws APIException
     */
    public function list(
        array|InvoiceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $invoiceID,
        array|InvoiceDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceAddNoteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function addNote(
        string $invoiceID,
        array|InvoiceAddNoteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceNewHostedLinkResponse>
     *
     * @throws APIException
     */
    public function createHostedLink(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function duplicate(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array<string,mixed>|InvoiceFinalizeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function finalize(
        string $invoiceID,
        array|InvoiceFinalizeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InvoiceListEventsResponse>
     *
     * @throws APIException
     */
    public function listEvents(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceMarkUncollectableParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function markUncollectable(
        string $invoiceID,
        array|InvoiceMarkUncollectableParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|InvoicePreviewParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function preview(
        array|InvoicePreviewParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoicePreviewExistingParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function previewExisting(
        string $invoiceID,
        array|InvoicePreviewExistingParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceRetryParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function retry(
        string $invoiceID,
        array|InvoiceRetryParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceSendParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function send(
        string $invoiceID,
        array|InvoiceSendParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array<string,mixed>|InvoiceUpdateDunningParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function updateDunning(
        string $invoiceID,
        array|InvoiceUpdateDunningParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param array<string,mixed>|InvoiceVoidParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function void(
        string $invoiceID,
        array|InvoiceVoidParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
