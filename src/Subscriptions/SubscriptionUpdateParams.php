<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @see Dodopayments\Services\SubscriptionsService::update()
 *
 * @phpstan-type SubscriptionUpdateParamsShape = array{
 *   billing?: null|BillingAddress|array{
 *     country: value-of<CountryCode>,
 *     city?: string|null,
 *     state?: string|null,
 *     street?: string|null,
 *     zipcode?: string|null,
 *   },
 *   cancel_at_next_billing_date?: bool|null,
 *   customer_name?: string|null,
 *   disable_on_demand?: null|DisableOnDemand|array{
 *     next_billing_date: \DateTimeInterface
 *   },
 *   metadata?: array<string,string>|null,
 *   next_billing_date?: \DateTimeInterface|null,
 *   status?: null|SubscriptionStatus|value-of<SubscriptionStatus>,
 *   tax_id?: string|null,
 * }
 */
final class SubscriptionUpdateParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?BillingAddress $billing;

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $cancel_at_next_billing_date;

    #[Api(nullable: true, optional: true)]
    public ?string $customer_name;

    #[Api(nullable: true, optional: true)]
    public ?DisableOnDemand $disable_on_demand;

    /** @var array<string,string>|null $metadata */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $next_billing_date;

    /** @var value-of<SubscriptionStatus>|null $status */
    #[Api(enum: SubscriptionStatus::class, nullable: true, optional: true)]
    public ?string $status;

    #[Api(nullable: true, optional: true)]
    public ?string $tax_id;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billing
     * @param DisableOnDemand|array{
     *   next_billing_date: \DateTimeInterface
     * }|null $disable_on_demand
     * @param array<string,string>|null $metadata
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public static function with(
        BillingAddress|array|null $billing = null,
        ?bool $cancel_at_next_billing_date = null,
        ?string $customer_name = null,
        DisableOnDemand|array|null $disable_on_demand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $next_billing_date = null,
        SubscriptionStatus|string|null $status = null,
        ?string $tax_id = null,
    ): self {
        $obj = new self;

        null !== $billing && $obj['billing'] = $billing;
        null !== $cancel_at_next_billing_date && $obj['cancel_at_next_billing_date'] = $cancel_at_next_billing_date;
        null !== $customer_name && $obj['customer_name'] = $customer_name;
        null !== $disable_on_demand && $obj['disable_on_demand'] = $disable_on_demand;
        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $next_billing_date && $obj['next_billing_date'] = $next_billing_date;
        null !== $status && $obj['status'] = $status;
        null !== $tax_id && $obj['tax_id'] = $tax_id;

        return $obj;
    }

    /**
     * @param BillingAddress|array{
     *   country: value-of<CountryCode>,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billing
     */
    public function withBilling(BillingAddress|array|null $billing): self
    {
        $obj = clone $this;
        $obj['billing'] = $billing;

        return $obj;
    }

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    public function withCancelAtNextBillingDate(
        ?bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj['cancel_at_next_billing_date'] = $cancelAtNextBillingDate;

        return $obj;
    }

    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj['customer_name'] = $customerName;

        return $obj;
    }

    /**
     * @param DisableOnDemand|array{
     *   next_billing_date: \DateTimeInterface
     * }|null $disableOnDemand
     */
    public function withDisableOnDemand(
        DisableOnDemand|array|null $disableOnDemand
    ): self {
        $obj = clone $this;
        $obj['disable_on_demand'] = $disableOnDemand;

        return $obj;
    }

    /**
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    public function withNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj['next_billing_date'] = $nextBillingDate;

        return $obj;
    }

    /**
     * @param SubscriptionStatus|value-of<SubscriptionStatus>|null $status
     */
    public function withStatus(SubscriptionStatus|string|null $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj['tax_id'] = $taxID;

        return $obj;
    }
}
