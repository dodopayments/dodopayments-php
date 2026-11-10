<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoiceUpdateParams\BillingAddress;
use Dodopayments\Invoices\InvoiceUpdateParams\Dunning;
use Dodopayments\Invoices\InvoiceUpdateParams\Item;
use Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\Type;
use Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms\UnionMember1;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\MetadataItem;

/**
 * Changes only the sent fields. `null` clears a field that can be empty.
 *
 * @see Dodopayments\Services\InvoicesService::update()
 *
 * @phpstan-import-type ItemVariants from \Dodopayments\Invoices\InvoiceUpdateParams\Item
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type PaymentTermsVariants from \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Invoices\InvoiceUpdateParams\BillingAddress
 * @phpstan-import-type DunningShape from \Dodopayments\Invoices\InvoiceUpdateParams\Dunning
 * @phpstan-import-type ItemShape from \Dodopayments\Invoices\InvoiceUpdateParams\Item
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Invoices\InvoiceUpdateParams\PaymentTerms
 *
 * @phpstan-type InvoiceUpdateParamsShape = array{
 *   ifMatch: string,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   ccEmails?: list<string>|null,
 *   collectionMethod?: null|CollectionMethod|value-of<CollectionMethod>,
 *   currency?: null|Currency|value-of<Currency>,
 *   customerEmail?: string|null,
 *   customerID?: string|null,
 *   discountIDs?: list<string>|null,
 *   dueAt?: \DateTimeInterface|null,
 *   dunning?: null|Dunning|DunningShape,
 *   items?: list<ItemShape>|null,
 *   memo?: string|null,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   paymentTerms?: PaymentTermsShape|null,
 *   reviewRequired?: bool|null,
 *   taxID?: string|null,
 * }
 */
final class InvoiceUpdateParams implements BaseModel
{
    /** @use SdkModel<InvoiceUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $ifMatch;

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

    /** @var value-of<CollectionMethod>|null $collectionMethod */
    #[Optional(
        'collection_method',
        enum: CollectionMethod::class,
        nullable: true
    )]
    public ?string $collectionMethod;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class, nullable: true)]
    public ?string $currency;

    #[Optional('customer_email', nullable: true)]
    public ?string $customerEmail;

    #[Optional('customer_id', nullable: true)]
    public ?string $customerID;

    /**
     * 20 codes or fewer.
     *
     * @var list<string>|null $discountIDs
     */
    #[Optional('discount_ids', list: 'string', nullable: true)]
    public ?array $discountIDs;

    #[Optional('due_at', nullable: true)]
    public ?\DateTimeInterface $dueAt;

    /**
     * The reminder override of one invoice. The business settings fill the other dunning values.
     */
    #[Optional(nullable: true)]
    public ?Dunning $dunning;

    /**
     * 1 to 50 items.
     *
     * @var list<ItemVariants>|null $items
     */
    #[Optional(list: Item::class, nullable: true)]
    public ?array $items;

    #[Optional(nullable: true)]
    public ?string $memo;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class, nullable: true)]
    public ?array $metadata;

    /** @var PaymentTermsVariants|null $paymentTerms */
    #[Optional('payment_terms', nullable: true)]
    public Type|UnionMember1|null $paymentTerms;

    #[Optional('review_required', nullable: true)]
    public ?bool $reviewRequired;

    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    /**
     * `new InvoiceUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceUpdateParams::with(ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceUpdateParams)->withIfMatch(...)
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
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param list<string>|null $ccEmails
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     * @param Currency|value-of<Currency>|null $currency
     * @param list<string>|null $discountIDs
     * @param Dunning|DunningShape|null $dunning
     * @param list<ItemShape>|null $items
     * @param array<string,MetadataItemShape>|null $metadata
     * @param PaymentTermsShape|null $paymentTerms
     */
    public static function with(
        string $ifMatch,
        BillingAddress|array|null $billingAddress = null,
        ?array $ccEmails = null,
        CollectionMethod|string|null $collectionMethod = null,
        Currency|string|null $currency = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?array $discountIDs = null,
        ?\DateTimeInterface $dueAt = null,
        Dunning|array|null $dunning = null,
        ?array $items = null,
        ?string $memo = null,
        ?array $metadata = null,
        Type|array|UnionMember1|null $paymentTerms = null,
        ?bool $reviewRequired = null,
        ?string $taxID = null,
    ): self {
        $self = new self;

        $self['ifMatch'] = $ifMatch;

        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $ccEmails && $self['ccEmails'] = $ccEmails;
        null !== $collectionMethod && $self['collectionMethod'] = $collectionMethod;
        null !== $currency && $self['currency'] = $currency;
        null !== $customerEmail && $self['customerEmail'] = $customerEmail;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $discountIDs && $self['discountIDs'] = $discountIDs;
        null !== $dueAt && $self['dueAt'] = $dueAt;
        null !== $dunning && $self['dunning'] = $dunning;
        null !== $items && $self['items'] = $items;
        null !== $memo && $self['memo'] = $memo;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $paymentTerms && $self['paymentTerms'] = $paymentTerms;
        null !== $reviewRequired && $self['reviewRequired'] = $reviewRequired;
        null !== $taxID && $self['taxID'] = $taxID;

        return $self;
    }

    public function withIfMatch(string $ifMatch): self
    {
        $self = clone $this;
        $self['ifMatch'] = $ifMatch;

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
     * @param CollectionMethod|value-of<CollectionMethod>|null $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string|null $collectionMethod
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency>|null $currency
     */
    public function withCurrency(Currency|string|null $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withCustomerEmail(?string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    public function withCustomerID(?string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

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

    /**
     * 1 to 50 items.
     *
     * @param list<ItemShape>|null $items
     */
    public function withItems(?array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

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
     * @param array<string,MetadataItemShape>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * @param PaymentTermsShape|null $paymentTerms
     */
    public function withPaymentTerms(
        Type|array|UnionMember1|null $paymentTerms
    ): self {
        $self = clone $this;
        $self['paymentTerms'] = $paymentTerms;

        return $self;
    }

    public function withReviewRequired(?bool $reviewRequired): self
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
