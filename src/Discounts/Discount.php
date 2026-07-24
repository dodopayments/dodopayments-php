<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Discounts\Discount\CurrencyOption;
use Dodopayments\Discounts\Discount\CustomerEligibility;
use Dodopayments\Misc\MetadataItem;

/**
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type CurrencyOptionShape from \Dodopayments\Discounts\Discount\CurrencyOption
 *
 * @phpstan-type DiscountShape = array{
 *   amount: int,
 *   businessID: string,
 *   code: string,
 *   createdAt: \DateTimeInterface,
 *   customerEligibility: CustomerEligibility|value-of<CustomerEligibility>,
 *   discountID: string,
 *   metadata: array<string,MetadataItemShape>,
 *   preserveOnPlanChange: bool,
 *   restrictedTo: list<string>,
 *   timesUsed: int,
 *   type: DiscountType|value-of<DiscountType>,
 *   currencyOptions?: list<CurrencyOption|CurrencyOptionShape>|null,
 *   expiresAt?: \DateTimeInterface|null,
 *   name?: string|null,
 *   perCustomerUsageLimit?: int|null,
 *   startsAt?: \DateTimeInterface|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * The discount amount in **basis points** (e.g., 540 => 5.4%).
     */
    #[Required]
    public int $amount;

    /**
     * The business this discount belongs to.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * The discount code (up to 16 chars).
     */
    #[Required]
    public string $code;

    /**
     * Timestamp when the discount is created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Who may redeem this discount code.
     *
     * @var value-of<CustomerEligibility> $customerEligibility
     */
    #[Required('customer_eligibility', enum: CustomerEligibility::class)]
    public string $customerEligibility;

    /**
     * The unique discount ID.
     */
    #[Required('discount_id')]
    public string $discountID;

    /**
     * Arbitrary key-value metadata. Values can be string, integer, number, or boolean.
     *
     * @var array<string,MetadataItemVariants> $metadata
     */
    #[Required(map: MetadataItem::class)]
    public array $metadata;

    /**
     * Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change).
     */
    #[Required('preserve_on_plan_change')]
    public bool $preserveOnPlanChange;

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @var list<string> $restrictedTo
     */
    #[Required('restricted_to', list: 'string')]
    public array $restrictedTo;

    /**
     * How many times this discount has been used.
     */
    #[Required('times_used')]
    public int $timesUsed;

    /**
     * The type of discount (`percentage` or `flat`).
     *
     * @var value-of<DiscountType> $type
     */
    #[Required(enum: DiscountType::class)]
    public string $type;

    /**
     * Per-currency options (flat deduction / percentage cap + minimum subtotal).
     * Empty for discounts without any configured currency options.
     *
     * @var list<CurrencyOption>|null $currencyOptions
     */
    #[Optional('currency_options', list: CurrencyOption::class)]
    public ?array $currencyOptions;

    /**
     * Optional date/time after which discount is expired.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Name for the Discount.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Maximum number of times a single customer may redeem this discount, if any.
     */
    #[Optional('per_customer_usage_limit', nullable: true)]
    public ?int $perCustomerUsageLimit;

    /**
     * Optional date/time before which the discount is not yet active. NULL = active immediately.
     */
    #[Optional('starts_at', nullable: true)]
    public ?\DateTimeInterface $startsAt;

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    #[Optional('subscription_cycles', nullable: true)]
    public ?int $subscriptionCycles;

    /**
     * Usage limit for this discount, if any.
     */
    #[Optional('usage_limit', nullable: true)]
    public ?int $usageLimit;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(
     *   amount: ...,
     *   businessID: ...,
     *   code: ...,
     *   createdAt: ...,
     *   customerEligibility: ...,
     *   discountID: ...,
     *   metadata: ...,
     *   preserveOnPlanChange: ...,
     *   restrictedTo: ...,
     *   timesUsed: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Discount)
     *   ->withAmount(...)
     *   ->withBusinessID(...)
     *   ->withCode(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerEligibility(...)
     *   ->withDiscountID(...)
     *   ->withMetadata(...)
     *   ->withPreserveOnPlanChange(...)
     *   ->withRestrictedTo(...)
     *   ->withTimesUsed(...)
     *   ->withType(...)
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
     * @param CustomerEligibility|value-of<CustomerEligibility> $customerEligibility
     * @param array<string,MetadataItemShape> $metadata
     * @param list<string> $restrictedTo
     * @param DiscountType|value-of<DiscountType> $type
     * @param list<CurrencyOption|CurrencyOptionShape>|null $currencyOptions
     */
    public static function with(
        int $amount,
        string $businessID,
        string $code,
        \DateTimeInterface $createdAt,
        CustomerEligibility|string $customerEligibility,
        string $discountID,
        array $metadata,
        bool $preserveOnPlanChange,
        array $restrictedTo,
        int $timesUsed,
        DiscountType|string $type,
        ?array $currencyOptions = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?int $perCustomerUsageLimit = null,
        ?\DateTimeInterface $startsAt = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['businessID'] = $businessID;
        $self['code'] = $code;
        $self['createdAt'] = $createdAt;
        $self['customerEligibility'] = $customerEligibility;
        $self['discountID'] = $discountID;
        $self['metadata'] = $metadata;
        $self['preserveOnPlanChange'] = $preserveOnPlanChange;
        $self['restrictedTo'] = $restrictedTo;
        $self['timesUsed'] = $timesUsed;
        $self['type'] = $type;

        null !== $currencyOptions && $self['currencyOptions'] = $currencyOptions;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $name && $self['name'] = $name;
        null !== $perCustomerUsageLimit && $self['perCustomerUsageLimit'] = $perCustomerUsageLimit;
        null !== $startsAt && $self['startsAt'] = $startsAt;
        null !== $subscriptionCycles && $self['subscriptionCycles'] = $subscriptionCycles;
        null !== $usageLimit && $self['usageLimit'] = $usageLimit;

        return $self;
    }

    /**
     * The discount amount in **basis points** (e.g., 540 => 5.4%).
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The business this discount belongs to.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * The discount code (up to 16 chars).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Timestamp when the discount is created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Who may redeem this discount code.
     *
     * @param CustomerEligibility|value-of<CustomerEligibility> $customerEligibility
     */
    public function withCustomerEligibility(
        CustomerEligibility|string $customerEligibility
    ): self {
        $self = clone $this;
        $self['customerEligibility'] = $customerEligibility;

        return $self;
    }

    /**
     * The unique discount ID.
     */
    public function withDiscountID(string $discountID): self
    {
        $self = clone $this;
        $self['discountID'] = $discountID;

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
     * Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change).
     */
    public function withPreserveOnPlanChange(bool $preserveOnPlanChange): self
    {
        $self = clone $this;
        $self['preserveOnPlanChange'] = $preserveOnPlanChange;

        return $self;
    }

    /**
     * List of product IDs to which this discount is restricted.
     *
     * @param list<string> $restrictedTo
     */
    public function withRestrictedTo(array $restrictedTo): self
    {
        $self = clone $this;
        $self['restrictedTo'] = $restrictedTo;

        return $self;
    }

    /**
     * How many times this discount has been used.
     */
    public function withTimesUsed(int $timesUsed): self
    {
        $self = clone $this;
        $self['timesUsed'] = $timesUsed;

        return $self;
    }

    /**
     * The type of discount (`percentage` or `flat`).
     *
     * @param DiscountType|value-of<DiscountType> $type
     */
    public function withType(DiscountType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Per-currency options (flat deduction / percentage cap + minimum subtotal).
     * Empty for discounts without any configured currency options.
     *
     * @param list<CurrencyOption|CurrencyOptionShape> $currencyOptions
     */
    public function withCurrencyOptions(array $currencyOptions): self
    {
        $self = clone $this;
        $self['currencyOptions'] = $currencyOptions;

        return $self;
    }

    /**
     * Optional date/time after which discount is expired.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Name for the Discount.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Maximum number of times a single customer may redeem this discount, if any.
     */
    public function withPerCustomerUsageLimit(?int $perCustomerUsageLimit): self
    {
        $self = clone $this;
        $self['perCustomerUsageLimit'] = $perCustomerUsageLimit;

        return $self;
    }

    /**
     * Optional date/time before which the discount is not yet active. NULL = active immediately.
     */
    public function withStartsAt(?\DateTimeInterface $startsAt): self
    {
        $self = clone $this;
        $self['startsAt'] = $startsAt;

        return $self;
    }

    /**
     * Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     */
    public function withSubscriptionCycles(?int $subscriptionCycles): self
    {
        $self = clone $this;
        $self['subscriptionCycles'] = $subscriptionCycles;

        return $self;
    }

    /**
     * Usage limit for this discount, if any.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $self = clone $this;
        $self['usageLimit'] = $usageLimit;

        return $self;
    }
}
