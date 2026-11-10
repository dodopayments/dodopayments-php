<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoicePreviewParams\BillingAddress;
use Dodopayments\Invoices\InvoicePreviewParams\Dunning;
use Dodopayments\Invoices\InvoicePreviewParams\Format;
use Dodopayments\Invoices\InvoicePreviewParams\Item;
use Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms;
use Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\DueOnReceipt;
use Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms\Net;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\MetadataItem;

/**
 * Prices the body as a draft and returns it. No row is saved.
 *
 * @see Dodopayments\Services\InvoicesService::preview()
 *
 * @phpstan-import-type ItemVariants from \Dodopayments\Invoices\InvoicePreviewParams\Item
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type PaymentTermsVariants from \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms
 * @phpstan-import-type ItemShape from \Dodopayments\Invoices\InvoicePreviewParams\Item
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\InvoicePreviewParams\BillingAddress
 * @phpstan-import-type DunningShape from \Dodopayments\Invoices\InvoicePreviewParams\Dunning
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Invoices\InvoicePreviewParams\PaymentTerms
 *
 * @phpstan-type InvoicePreviewParamsShape = array{
 *   collectionMethod: CollectionMethod|value-of<CollectionMethod>,
 *   currency: Currency|value-of<Currency>,
 *   customerID: string,
 *   items: list<ItemShape>,
 *   format?: null|Format|value-of<Format>,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   ccEmails?: list<string>|null,
 *   customerEmail?: string|null,
 *   discountIDs?: list<string>|null,
 *   dueAt?: \DateTimeInterface|null,
 *   dunning?: null|Dunning|DunningShape,
 *   memo?: string|null,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   paymentTerms?: PaymentTermsShape|null,
 *   reviewRequired?: bool|null,
 *   taxID?: string|null,
 * }
 */
final class InvoicePreviewParams implements BaseModel
{
    /** @use SdkModel<InvoicePreviewParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<CollectionMethod> $collectionMethod */
    #[Required('collection_method', enum: CollectionMethod::class)]
    public string $collectionMethod;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('customer_id')]
    public string $customerID;

    /**
     * 1 to 50 items.
     *
     * @var list<ItemVariants> $items
     */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * The billing address of an invoice request.
     */
    #[Optional('billing_address', nullable: true)]
    public ?BillingAddress $billingAddress;

    /**
     * 10 addresses or fewer.
     *
     * @var list<string>|null $ccEmails
     */
    #[Optional('cc_emails', list: 'string', nullable: true)]
    public ?array $ccEmails;

    /**
     * The customer email is used when this is not set.
     */
    #[Optional('customer_email', nullable: true)]
    public ?string $customerEmail;

    /**
     * 20 codes or fewer.
     *
     * @var list<string>|null $discountIDs
     */
    #[Optional('discount_ids', list: 'string', nullable: true)]
    public ?array $discountIDs;

    /**
     * A custom due date. Do not send it with `payment_terms`.
     */
    #[Optional('due_at', nullable: true)]
    public ?\DateTimeInterface $dueAt;

    /**
     * The reminder override of one invoice. The business settings fill the other dunning values.
     */
    #[Optional(nullable: true)]
    public ?Dunning $dunning;

    #[Optional(nullable: true)]
    public ?string $memo;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class)]
    public ?array $metadata;

    /**
     * Do not send it with `due_at`.
     *
     * @var PaymentTermsVariants|null $paymentTerms
     */
    #[Optional('payment_terms', union: PaymentTerms::class, nullable: true)]
    public DueOnReceipt|Net|null $paymentTerms;

    /**
     * `true` keeps a renewal draft for review before it finalises.
     */
    #[Optional('review_required')]
    public ?bool $reviewRequired;

    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    /**
     * `new InvoicePreviewParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoicePreviewParams::with(
     *   collectionMethod: ..., currency: ..., customerID: ..., items: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoicePreviewParams)
     *   ->withCollectionMethod(...)
     *   ->withCurrency(...)
     *   ->withCustomerID(...)
     *   ->withItems(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     * @param Currency|value-of<Currency> $currency
     * @param list<ItemShape> $items
     * @param Format|value-of<Format>|null $format
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param list<string>|null $ccEmails
     * @param list<string>|null $discountIDs
     * @param Dunning|DunningShape|null $dunning
     * @param array<string,MetadataItemShape>|null $metadata
     * @param PaymentTermsShape|null $paymentTerms
     */
    public static function with(
        CollectionMethod|string $collectionMethod,
        Currency|string $currency,
        string $customerID,
        array $items,
        Format|string|null $format = null,
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
    ): self {
        $self = new self;

        $self['collectionMethod'] = $collectionMethod;
        $self['currency'] = $currency;
        $self['customerID'] = $customerID;
        $self['items'] = $items;

        null !== $format && $self['format'] = $format;
        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $ccEmails && $self['ccEmails'] = $ccEmails;
        null !== $customerEmail && $self['customerEmail'] = $customerEmail;
        null !== $discountIDs && $self['discountIDs'] = $discountIDs;
        null !== $dueAt && $self['dueAt'] = $dueAt;
        null !== $dunning && $self['dunning'] = $dunning;
        null !== $memo && $self['memo'] = $memo;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $paymentTerms && $self['paymentTerms'] = $paymentTerms;
        null !== $reviewRequired && $self['reviewRequired'] = $reviewRequired;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string $collectionMethod
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * 1 to 50 items.
     *
     * @param list<ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * The preview body. `json` returns the invoice JSON. `pdf` returns the PDF with a draft mark.
     * `email` returns the HTML of the invoice email. A preview saves no row.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * The billing address of an invoice request.
     *
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array|null $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * 10 addresses or fewer.
     *
     * @param list<string>|null $ccEmails
     */
    public function withCcEmails(?array $ccEmails): self
    {
        $self = clone $this;
        $self['ccEmails'] = $ccEmails;

        return $self;
    }

    /**
     * The customer email is used when this is not set.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    /**
     * 20 codes or fewer.
     *
     * @param list<string>|null $discountIDs
     */
    public function withDiscountIDs(?array $discountIDs): self
    {
        $self = clone $this;
        $self['discountIDs'] = $discountIDs;

        return $self;
    }

    /**
     * A custom due date. Do not send it with `payment_terms`.
     */
    public function withDueAt(?\DateTimeInterface $dueAt): self
    {
        $self = clone $this;
        $self['dueAt'] = $dueAt;

        return $self;
    }

    /**
     * The reminder override of one invoice. The business settings fill the other dunning values.
     *
     * @param Dunning|DunningShape|null $dunning
     */
    public function withDunning(Dunning|array|null $dunning): self
    {
        $self = clone $this;
        $self['dunning'] = $dunning;

        return $self;
    }

    public function withMemo(?string $memo): self
    {
        $self = clone $this;
        $self['memo'] = $memo;

        return $self;
    }

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @param array<string,MetadataItemShape> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Do not send it with `due_at`.
     *
     * @param PaymentTermsShape|null $paymentTerms
     */
    public function withPaymentTerms(
        DueOnReceipt|array|Net|null $paymentTerms
    ): self {
        $self = clone $this;
        $self['paymentTerms'] = $paymentTerms;

        return $self;
    }

    /**
     * `true` keeps a renewal draft for review before it finalises.
     */
    public function withReviewRequired(bool $reviewRequired): self
    {
        $self = clone $this;
        $self['reviewRequired'] = $reviewRequired;

        return $self;
    }

    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }
}
