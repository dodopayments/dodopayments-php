<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Invoices\Invoice;
use Dodopayments\Invoices\InvoiceAddNoteParams;
use Dodopayments\Invoices\InvoiceCreateParams;
use Dodopayments\Invoices\InvoiceCreateParams\BillingAddress;
use Dodopayments\Invoices\InvoiceCreateParams\Dunning;
use Dodopayments\Invoices\InvoiceDeleteParams;
use Dodopayments\Invoices\InvoiceFinalizeParams;
use Dodopayments\Invoices\InvoiceListEventsResponse;
use Dodopayments\Invoices\InvoiceListParams;
use Dodopayments\Invoices\InvoiceListParams\Status;
use Dodopayments\Invoices\InvoiceListParams\Tag;
use Dodopayments\Invoices\InvoiceMarkUncollectableParams;
use Dodopayments\Invoices\InvoiceNewHostedLinkResponse;
use Dodopayments\Invoices\InvoicePreviewExistingParams;
use Dodopayments\Invoices\InvoicePreviewParams;
use Dodopayments\Invoices\InvoicePreviewParams\Format;
use Dodopayments\Invoices\InvoiceRetryParams;
use Dodopayments\Invoices\InvoiceSendParams;
use Dodopayments\Invoices\InvoiceUpdateDunningParams;
use Dodopayments\Invoices\InvoiceUpdateDunningParams\Action;
use Dodopayments\Invoices\InvoiceUpdateParams;
use Dodopayments\Invoices\InvoiceVoidParams;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\InvoicesRawContract;

/**
 * @phpstan-import-type ItemShape from \Dodopayments\Invoices\InvoiceCreateParams\Item
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\InvoiceCreateParams\BillingAddress
 * @phpstan-import-type DunningShape from \Dodopayments\Invoices\InvoiceCreateParams\Dunning
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\InvoiceUpdateParams\BillingAddress as BillingAddressShape1
 * @phpstan-import-type DunningShape from \Dodopayments\Invoices\InvoiceUpdateParams\Dunning as DunningShape1
 * @phpstan-import-type ItemShape from \Dodopayments\Invoices\InvoiceUpdateParams\Item as ItemShape1
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms as PaymentTermsShape1
 * @phpstan-import-type ItemShape from \Dodopayments\Invoices\InvoicePreviewParams\Item as ItemShape2
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\InvoicePreviewParams\BillingAddress as BillingAddressShape2
 * @phpstan-import-type DunningShape from \Dodopayments\Invoices\InvoicePreviewParams\Dunning as DunningShape2
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms as PaymentTermsShape2
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class InvoicesRawService implements InvoicesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a draft. A repeat with the same `Idempotency-Key` returns the first draft.
     *
     * @param array{
     *   collectionMethod: CollectionMethod|value-of<CollectionMethod>,
     *   currency: value-of<Currency>,
     *   customerID: string,
     *   items: list<ItemShape>,
     *   billingAddress?: BillingAddress|BillingAddressShape|null,
     *   ccEmails?: list<string>|null,
     *   customerEmail?: string|null,
     *   discountIDs?: list<string>|null,
     *   dueAt?: \DateTimeInterface|null,
     *   dunning?: Dunning|DunningShape|null,
     *   memo?: string|null,
     *   metadata?: array<string,MetadataItemShape>,
     *   paymentTerms?: PaymentTermsShape|null,
     *   reviewRequired?: bool,
     *   taxID?: string|null,
     *   idempotencyKey?: string,
     * }|InvoiceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Invoice>
     *
     * @throws APIException
     */
    public function create(
        array|InvoiceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoiceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['idempotencyKey' => 'Idempotency-Key'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'billing/invoices',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Get an invoice
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['billing/invoices/%1$s', $invoiceID],
            options: $requestOptions,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Changes only the sent fields. `null` clears a field that can be empty.
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array{
     *   ifMatch: string,
     *   billingAddress?: InvoiceUpdateParams\BillingAddress|BillingAddressShape1|null,
     *   ccEmails?: list<string>|null,
     *   collectionMethod?: CollectionMethod|value-of<CollectionMethod>|null,
     *   currency?: value-of<Currency>,
     *   customerEmail?: string|null,
     *   customerID?: string|null,
     *   discountIDs?: list<string>|null,
     *   dueAt?: \DateTimeInterface|null,
     *   dunning?: InvoiceUpdateParams\Dunning|DunningShape1|null,
     *   items?: list<ItemShape1>|null,
     *   memo?: string|null,
     *   metadata?: array<string,MetadataItemShape>|null,
     *   paymentTerms?: PaymentTermsShape1|null,
     *   reviewRequired?: bool|null,
     *   taxID?: string|null,
     * }|InvoiceUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['ifMatch' => 'If-Match'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['billing/invoices/%1$s', $invoiceID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Lists invoice-led invoices, newest first. The items have no `lines` and no `payments`.
     *
     * @param array{
     *   collectionMethod?: InvoiceListParams\CollectionMethod|value-of<InvoiceListParams\CollectionMethod>,
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   dueAtGte?: \DateTimeInterface,
     *   dueAtLte?: \DateTimeInterface,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: list<Status|value-of<Status>>,
     *   subscriptionID?: string,
     *   tags?: list<Tag|value-of<Tag>>,
     *   totalAmountGte?: int,
     *   totalAmountLte?: int,
     * }|InvoiceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Invoice>>
     *
     * @throws APIException
     */
    public function list(
        array|InvoiceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoiceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'billing/invoices',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'collectionMethod' => 'collection_method',
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'dueAtGte' => 'due_at_gte',
                    'dueAtLte' => 'due_at_lte',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'subscriptionID' => 'subscription_id',
                    'totalAmountGte' => 'total_amount_gte',
                    'totalAmountLte' => 'total_amount_lte',
                ],
            ),
            options: $options,
            convert: Invoice::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * Delete a draft invoice
     *
     * @param string $invoiceID Invoice ID
     * @param array{ifMatch: string}|InvoiceDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['billing/invoices/%1$s', $invoiceID],
            headers: Util::array_transform_keys($parsed, ['ifMatch' => 'If-Match']),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * A note changes no field, so it needs no `If-Match`. The note shows in `/events`.
     *
     * @param string $invoiceID Invoice ID
     * @param array{text: string}|InvoiceAddNoteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceAddNoteParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/notes', $invoiceID],
            body: (object) $parsed,
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Returns the page where the customer pays. A copied link counts as a send, so the first
     * call sets `sent_at`.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/hosted-link', $invoiceID],
            options: $requestOptions,
            convert: InvoiceNewHostedLinkResponse::class,
        );
    }

    /**
     * @api
     *
     * Copies the customer, the product lines, the terms and the recipients into a new draft.
     * Usage lines are not copied.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/duplicate', $invoiceID],
            options: $requestOptions,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Issues the draft. With `send: true`, the invoice email goes out after the issue.
     * A failed send keeps the invoice issued. Call `/send` again with the new `ETag`.
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array{
     *   ifMatch: string,
     *   ccEmails?: list<string>|null,
     *   customerEmail?: string|null,
     *   send?: bool,
     * }|InvoiceFinalizeParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceFinalizeParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['ifMatch' => 'If-Match'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/finalize', $invoiceID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Returns the change history of the invoice, oldest first.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['billing/invoices/%1$s/events', $invoiceID],
            options: $requestOptions,
            convert: InvoiceListEventsResponse::class,
        );
    }

    /**
     * @api
     *
     * Mark an invoice uncollectable
     *
     * @param string $invoiceID Invoice ID
     * @param array{ifMatch: string}|InvoiceMarkUncollectableParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceMarkUncollectableParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/mark-uncollectable', $invoiceID],
            headers: Util::array_transform_keys($parsed, ['ifMatch' => 'If-Match']),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Prices the body as a draft and returns it. No row is saved.
     *
     * @param array{
     *   collectionMethod: CollectionMethod|value-of<CollectionMethod>,
     *   currency: value-of<Currency>,
     *   customerID: string,
     *   items: list<ItemShape2>,
     *   format?: Format|value-of<Format>,
     *   billingAddress?: InvoicePreviewParams\BillingAddress|BillingAddressShape2|null,
     *   ccEmails?: list<string>|null,
     *   customerEmail?: string|null,
     *   discountIDs?: list<string>|null,
     *   dueAt?: \DateTimeInterface|null,
     *   dunning?: InvoicePreviewParams\Dunning|DunningShape2|null,
     *   memo?: string|null,
     *   metadata?: array<string,MetadataItemShape>,
     *   paymentTerms?: PaymentTermsShape2|null,
     *   reviewRequired?: bool,
     *   taxID?: string|null,
     * }|InvoicePreviewParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function preview(
        array|InvoicePreviewParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvoicePreviewParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['format']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'billing/invoices/preview',
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Preview a draft invoice
     *
     * @param string $invoiceID Invoice ID
     * @param array{
     *   format?: InvoicePreviewExistingParams\Format|value-of<InvoicePreviewExistingParams\Format>,
     * }|InvoicePreviewExistingParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoicePreviewExistingParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['billing/invoices/%1$s/preview', $invoiceID],
            query: $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Charges the saved payment method of the invoice subscription now.
     *
     * @param string $invoiceID Invoice ID
     * @param array{ifMatch: string}|InvoiceRetryParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceRetryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/retry', $invoiceID],
            headers: Util::array_transform_keys($parsed, ['ifMatch' => 'If-Match']),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Emails the invoice to the customer email and the CC emails.
     *
     * @param string $invoiceID Invoice ID
     * @param array{ifMatch: string}|InvoiceSendParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/send', $invoiceID],
            headers: Util::array_transform_keys($parsed, ['ifMatch' => 'If-Match']),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Pauses, resumes or moves the reminders of an open or past-due invoice.
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param array{
     *   action: Action|value-of<Action>, ifMatch: string, offsetsDays?: list<int>|null
     * }|InvoiceUpdateDunningParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceUpdateDunningParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['ifMatch' => 'If-Match'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/dunning', $invoiceID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Invoice::class,
        );
    }

    /**
     * @api
     *
     * Closes an open or past-due invoice. Applied credits go back to the customer wallet.
     *
     * @param string $invoiceID Invoice ID
     * @param array{ifMatch: string}|InvoiceVoidParams $params
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
    ): BaseResponse {
        [$parsed, $options] = InvoiceVoidParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['billing/invoices/%1$s/void', $invoiceID],
            headers: Util::array_transform_keys($parsed, ['ifMatch' => 'If-Match']),
            options: $options,
            convert: Invoice::class,
        );
    }
}
