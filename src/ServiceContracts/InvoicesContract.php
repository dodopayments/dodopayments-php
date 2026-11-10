<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Invoices\Invoice;
use Dodopayments\Invoices\InvoiceCreateParams\BillingAddress;
use Dodopayments\Invoices\InvoiceCreateParams\Dunning;
use Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\DueOnReceipt;
use Dodopayments\Invoices\InvoiceCreateParams\PaymentTerms\Net;
use Dodopayments\Invoices\InvoiceListEventsResponse;
use Dodopayments\Invoices\InvoiceListParams\Status;
use Dodopayments\Invoices\InvoiceListParams\Tag;
use Dodopayments\Invoices\InvoiceNewHostedLinkResponse;
use Dodopayments\Invoices\InvoicePreviewParams\Format;
use Dodopayments\Invoices\InvoiceUpdateDunningParams\Action;
use Dodopayments\Misc\Currency;
use Dodopayments\RequestOptions;

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
interface InvoicesContract
{
    /**
     * @api
     *
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod Body param
     * @param Currency|value-of<Currency> $currency Body param
     * @param string $customerID Body param
     * @param list<ItemShape> $items body param: 1 to 50 items
     * @param BillingAddress|BillingAddressShape|null $billingAddress body param: The billing address of an invoice request
     * @param list<string>|null $ccEmails body param: 10 addresses or fewer
     * @param string|null $customerEmail body param: The customer email is used when this is not set
     * @param list<string>|null $discountIDs body param: 20 codes or fewer
     * @param \DateTimeInterface|null $dueAt Body param: A custom due date. Do not send it with `payment_terms`.
     * @param Dunning|DunningShape|null $dunning Body param: The reminder override of one invoice. The business settings fill the other dunning values.
     * @param string|null $memo Body param
     * @param array<string,MetadataItemShape> $metadata Body param: Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     * @param PaymentTermsShape|null $paymentTerms body param: Do not send it with `due_at`
     * @param bool $reviewRequired body param: `true` keeps a renewal draft for review before it finalises
     * @param string|null $taxID Body param
     * @param string $idempotencyKey Header param: A key of 1 to 255 characters. A repeat with the same key returns the first draft.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        CollectionMethod|string $collectionMethod,
        Currency|string $currency,
        string $customerID,
        array $items,
        BillingAddress|array|null $billingAddress = null,
        ?array $ccEmails = null,
        ?string $customerEmail = null,
        ?array $discountIDs = null,
        ?\DateTimeInterface $dueAt = null,
        Dunning|array|null $dunning = null,
        ?string $memo = null,
        ?array $metadata = null,
        DueOnReceipt|array|Net|null $paymentTerms = null,
        ?bool $reviewRequired = null,
        ?string $taxID = null,
        ?string $idempotencyKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param string $ifMatch header param: The row_version of the invoice that the request changes
     * @param \Dodopayments\Invoices\InvoiceUpdateParams\BillingAddress|BillingAddressShape1|null $billingAddress body param: The billing address of an invoice request
     * @param list<string>|null $ccEmails body param: 10 addresses or fewer
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod Body param
     * @param Currency|value-of<Currency>|null $currency Body param
     * @param string|null $customerEmail Body param
     * @param string|null $customerID Body param
     * @param list<string>|null $discountIDs body param: 20 codes or fewer
     * @param \DateTimeInterface|null $dueAt Body param
     * @param \Dodopayments\Invoices\InvoiceUpdateParams\Dunning|DunningShape1|null $dunning Body param: The reminder override of one invoice. The business settings fill the other dunning values.
     * @param list<ItemShape1>|null $items body param: 1 to 50 items
     * @param string|null $memo Body param
     * @param array<string,MetadataItemShape>|null $metadata Body param: Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     * @param PaymentTermsShape1|null $paymentTerms Body param
     * @param bool|null $reviewRequired Body param
     * @param string|null $taxID Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $invoiceID,
        string $ifMatch,
        \Dodopayments\Invoices\InvoiceUpdateParams\BillingAddress|array|null $billingAddress = null,
        ?array $ccEmails = null,
        CollectionMethod|string|null $collectionMethod = null,
        Currency|string|null $currency = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?array $discountIDs = null,
        ?\DateTimeInterface $dueAt = null,
        \Dodopayments\Invoices\InvoiceUpdateParams\Dunning|array|null $dunning = null,
        ?array $items = null,
        ?string $memo = null,
        ?array $metadata = null,
        \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\DueOnReceipt|array|\Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\Net|null $paymentTerms = null,
        ?bool $reviewRequired = null,
        ?string $taxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param \Dodopayments\Invoices\InvoiceListParams\CollectionMethod|value-of<\Dodopayments\Invoices\InvoiceListParams\CollectionMethod> $collectionMethod
     * @param int $pageNumber Page number. The default is 0.
     * @param int $pageSize Page size. The default is 10 and the maximum is 100.
     * @param list<Status|value-of<Status>> $status repeat the key to match more than one status, for example `status=open&status=past_due`
     * @param list<Tag|value-of<Tag>> $tags repeat the key to match an invoice that has any one of the tags
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Invoice>
     *
     * @throws APIException
     */
    public function list(
        \Dodopayments\Invoices\InvoiceListParams\CollectionMethod|string|null $collectionMethod = null,
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?string $customerID = null,
        ?\DateTimeInterface $dueAtGte = null,
        ?\DateTimeInterface $dueAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?array $status = null,
        ?string $subscriptionID = null,
        ?array $tags = null,
        ?int $totalAmountGte = null,
        ?int $totalAmountLte = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param string $ifMatch the row_version of the invoice that the request changes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $invoiceID,
        string $ifMatch,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function addNote(
        string $invoiceID,
        string $text,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createHostedLink(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceNewHostedLinkResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function duplicate(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param string $ifMatch header param: The row_version of the invoice that the request changes
     * @param list<string>|null $ccEmails body param: 10 addresses or fewer
     * @param string|null $customerEmail Body param
     * @param bool $send body param: `true` sends the invoice email after finalise
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function finalize(
        string $invoiceID,
        string $ifMatch,
        ?array $ccEmails = null,
        ?string $customerEmail = null,
        ?bool $send = null,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listEvents(
        string $invoiceID,
        RequestOptions|array|null $requestOptions = null
    ): InvoiceListEventsResponse;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param string $ifMatch the row_version of the invoice that the request changes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function markUncollectable(
        string $invoiceID,
        string $ifMatch,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod Body param
     * @param Currency|value-of<Currency> $currency Body param
     * @param string $customerID Body param
     * @param list<ItemShape2> $items body param: 1 to 50 items
     * @param Format|value-of<Format> $format Query param: The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     * @param \Dodopayments\Invoices\InvoicePreviewParams\BillingAddress|BillingAddressShape2|null $billingAddress body param: The billing address of an invoice request
     * @param list<string>|null $ccEmails body param: 10 addresses or fewer
     * @param string|null $customerEmail body param: The customer email is used when this is not set
     * @param list<string>|null $discountIDs body param: 20 codes or fewer
     * @param \DateTimeInterface|null $dueAt Body param: A custom due date. Do not send it with `payment_terms`.
     * @param \Dodopayments\Invoices\InvoicePreviewParams\Dunning|DunningShape2|null $dunning Body param: The reminder override of one invoice. The business settings fill the other dunning values.
     * @param string|null $memo Body param
     * @param array<string,MetadataItemShape> $metadata Body param: Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     * @param PaymentTermsShape2|null $paymentTerms body param: Do not send it with `due_at`
     * @param bool $reviewRequired body param: `true` keeps a renewal draft for review before it finalises
     * @param string|null $taxID Body param
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function preview(
        CollectionMethod|string $collectionMethod,
        Currency|string $currency,
        string $customerID,
        array $items,
        Format|string|null $format = null,
        \Dodopayments\Invoices\InvoicePreviewParams\BillingAddress|array|null $billingAddress = null,
        ?array $ccEmails = null,
        ?string $customerEmail = null,
        ?array $discountIDs = null,
        ?\DateTimeInterface $dueAt = null,
        \Dodopayments\Invoices\InvoicePreviewParams\Dunning|array|null $dunning = null,
        ?string $memo = null,
        ?array $metadata = null,
        \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\DueOnReceipt|array|\Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\Net|null $paymentTerms = null,
        ?bool $reviewRequired = null,
        ?string $taxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param \Dodopayments\Invoices\InvoicePreviewExistingParams\Format|value-of<\Dodopayments\Invoices\InvoicePreviewExistingParams\Format> $format The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function previewExisting(
        string $invoiceID,
        \Dodopayments\Invoices\InvoicePreviewExistingParams\Format|string|null $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param string $ifMatch the row_version of the invoice that the request changes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retry(
        string $invoiceID,
        string $ifMatch,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param string $ifMatch the row_version of the invoice that the request changes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $invoiceID,
        string $ifMatch,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Path param: Invoice ID
     * @param Action|value-of<Action> $action Body param
     * @param string $ifMatch header param: The row_version of the invoice that the request changes
     * @param list<int>|null $offsetsDays Body param: Needed for `reschedule`. Days from the due date.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateDunning(
        string $invoiceID,
        Action|string $action,
        string $ifMatch,
        ?array $offsetsDays = null,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;

    /**
     * @api
     *
     * @param string $invoiceID Invoice ID
     * @param string $ifMatch the row_version of the invoice that the request changes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function void(
        string $invoiceID,
        string $ifMatch,
        RequestOptions|array|null $requestOptions = null,
    ): Invoice;
}
