<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Discounts\DiscountCreateParams\CurrencyOption;
use Dodopayments\Discounts\DiscountCreateParams\CustomerEligibility;
use Dodopayments\Misc\MetadataItem;

/**
 * POST /discounts
 * If `code` is omitted or empty, a random 16-char uppercase code is generated.
 *
 * @see Dodopayments\Services\DiscountsService::create()
 *
 * @phpstan-import-type MetadataItemVariants from \Dodopayments\Misc\MetadataItem
 * @phpstan-import-type CurrencyOptionShape from \Dodopayments\Discounts\DiscountCreateParams\CurrencyOption
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
 *
 * @phpstan-type DiscountCreateParamsShape = array{
 *   amount: int,
 *   type: DiscountType|value-of<DiscountType>,
 *   code?: string|null,
 *   currencyOptions?: list<CurrencyOption|CurrencyOptionShape>|null,
 *   customerEligibility?: null|CustomerEligibility|value-of<CustomerEligibility>,
 *   expiresAt?: \DateTimeInterface|null,
 *   metadata?: array<string,MetadataItemShape>|null,
 *   name?: string|null,
 *   perCustomerUsageLimit?: int|null,
 *   preserveOnPlanChange?: bool|null,
 *   restrictedTo?: list<string>|null,
 *   startsAt?: \DateTimeInterface|null,
 *   subscriptionCycles?: int|null,
 *   usageLimit?: int|null,
 * }
 */
final class DiscountCreateParams implements BaseModel
{
    /** @use SdkModel<DiscountCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The discount amount in **basis points** (e.g. `540` means `5.4%`, `10000` means `100%`).
     *
     * Must be at least 1.
     */
    #[Required]
    public int $amount;

    /**
     * The discount type: `percentage` or `flat` (`flat_per_unit` stays blocked).
     *
     * @var value-of<DiscountType> $type
     */
    #[Required(enum: DiscountType::class)]
    public string $type;

    /**
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    #[Optional(nullable: true)]
    public ?string $code;

    /**
     * Per-currency options (flat deduction / percentage cap + minimum subtotal).
     * Required for `flat` codes (must include a resolvable default); optional
     * per-currency caps for `percentage` codes. Per-row invariants are checked
     * in `normalize_currency_options`, not via `#[validate(nested)]`.
     *
     * @var list<CurrencyOption>|null $currencyOptions
     */
    #[Optional('currency_options', list: CurrencyOption::class, nullable: true)]
    public ?array $currencyOptions;

    /**
     * Who may redeem this discount code. Defaults to `any` (unrestricted).
     * `specific` starts with zero attached customers (fails closed) until
     * customers are attached via `POST /discounts/{id}/customers`.
     *
     * @var value-of<CustomerEligibility>|null $customerEligibility
     */
    #[Optional(
        'customer_eligibility',
        enum: CustomerEligibility::class,
        nullable: true
    )]
    public ?string $customerEligibility;

    /**
     * When the discount expires, if ever.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Additional metadata for the discount.
     *
     * @var array<string,MetadataItemVariants>|null $metadata
     */
    #[Optional(map: MetadataItem::class)]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Maximum number of times a single customer may redeem this discount.
     * Must be `<= usage_limit` when both are set.
     */
    #[Optional('per_customer_usage_limit', nullable: true)]
    public ?int $perCustomerUsageLimit;

    /**
     * Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change).
     */
    #[Optional('preserve_on_plan_change')]
    public ?bool $preserveOnPlanChange;

    /**
     * List of product IDs to restrict usage (if any).
     *
     * @var list<string>|null $restrictedTo
     */
    #[Optional('restricted_to', list: 'string', nullable: true)]
    public ?array $restrictedTo;

    /**
     * When the discount becomes active, if scheduled for the future.
     * NULL = active immediately. Must be strictly before `expires_at` when both are set.
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
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    #[Optional('usage_limit', nullable: true)]
    public ?int $usageLimit;

    /**
     * `new DiscountCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DiscountCreateParams::with(amount: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DiscountCreateParams)->withAmount(...)->withType(...)
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
     * @param DiscountType|value-of<DiscountType> $type
     * @param list<CurrencyOption|CurrencyOptionShape>|null $currencyOptions
     * @param CustomerEligibility|value-of<CustomerEligibility>|null $customerEligibility
     * @param array<string,MetadataItemShape>|null $metadata
     * @param list<string>|null $restrictedTo
     */
    public static function with(
        int $amount,
        DiscountType|string $type,
        ?string $code = null,
        ?array $currencyOptions = null,
        CustomerEligibility|string|null $customerEligibility = null,
        ?\DateTimeInterface $expiresAt = null,
        ?array $metadata = null,
        ?string $name = null,
        ?int $perCustomerUsageLimit = null,
        ?bool $preserveOnPlanChange = null,
        ?array $restrictedTo = null,
        ?\DateTimeInterface $startsAt = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['type'] = $type;

        null !== $code && $self['code'] = $code;
        null !== $currencyOptions && $self['currencyOptions'] = $currencyOptions;
        null !== $customerEligibility && $self['customerEligibility'] = $customerEligibility;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $perCustomerUsageLimit && $self['perCustomerUsageLimit'] = $perCustomerUsageLimit;
        null !== $preserveOnPlanChange && $self['preserveOnPlanChange'] = $preserveOnPlanChange;
        null !== $restrictedTo && $self['restrictedTo'] = $restrictedTo;
        null !== $startsAt && $self['startsAt'] = $startsAt;
        null !== $subscriptionCycles && $self['subscriptionCycles'] = $subscriptionCycles;
        null !== $usageLimit && $self['usageLimit'] = $usageLimit;

        return $self;
    }

    /**
     * The discount amount in **basis points** (e.g. `540` means `5.4%`, `10000` means `100%`).
     *
     * Must be at least 1.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The discount type: `percentage` or `flat` (`flat_per_unit` stays blocked).
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
     * Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     */
    public function withCode(?string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Per-currency options (flat deduction / percentage cap + minimum subtotal).
     * Required for `flat` codes (must include a resolvable default); optional
     * per-currency caps for `percentage` codes. Per-row invariants are checked
     * in `normalize_currency_options`, not via `#[validate(nested)]`.
     *
     * @param list<CurrencyOption|CurrencyOptionShape>|null $currencyOptions
     */
    public function withCurrencyOptions(?array $currencyOptions): self
    {
        $self = clone $this;
        $self['currencyOptions'] = $currencyOptions;

        return $self;
    }

    /**
     * Who may redeem this discount code. Defaults to `any` (unrestricted).
     * `specific` starts with zero attached customers (fails closed) until
     * customers are attached via `POST /discounts/{id}/customers`.
     *
     * @param CustomerEligibility|value-of<CustomerEligibility>|null $customerEligibility
     */
    public function withCustomerEligibility(
        CustomerEligibility|string|null $customerEligibility
    ): self {
        $self = clone $this;
        $self['customerEligibility'] = $customerEligibility;

        return $self;
    }

    /**
     * When the discount expires, if ever.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Additional metadata for the discount.
     *
     * @param array<string,MetadataItemShape> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Maximum number of times a single customer may redeem this discount.
     * Must be `<= usage_limit` when both are set.
     */
    public function withPerCustomerUsageLimit(?int $perCustomerUsageLimit): self
    {
        $self = clone $this;
        $self['perCustomerUsageLimit'] = $perCustomerUsageLimit;

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
     * List of product IDs to restrict usage (if any).
     *
     * @param list<string>|null $restrictedTo
     */
    public function withRestrictedTo(?array $restrictedTo): self
    {
        $self = clone $this;
        $self['restrictedTo'] = $restrictedTo;

        return $self;
    }

    /**
     * When the discount becomes active, if scheduled for the future.
     * NULL = active immediately. Must be strictly before `expires_at` when both are set.
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
     * How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     */
    public function withUsageLimit(?int $usageLimit): self
    {
        $self = clone $this;
        $self['usageLimit'] = $usageLimit;

        return $self;
    }
}
