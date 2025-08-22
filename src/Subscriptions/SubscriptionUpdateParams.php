<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\MapOf;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionUpdateParams\DisableOnDemand;

/**
 * @phpstan-type update_params = array{
 *   billing?: BillingAddress,
 *   cancelAtNextBillingDate?: bool|null,
 *   disableOnDemand?: DisableOnDemand|null,
 *   metadata?: array<string, string>|null,
 *   nextBillingDate?: \DateTimeInterface|null,
 *   status?: SubscriptionStatus::*,
 *   taxID?: string|null,
 * }
 */
final class SubscriptionUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
    public ?BillingAddress $billing;

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    #[Api('cancel_at_next_billing_date', optional: true)]
    public ?bool $cancelAtNextBillingDate;

    #[Api('disable_on_demand', optional: true)]
    public ?DisableOnDemand $disableOnDemand;

    /** @var array<string, string>|null $metadata */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

    #[Api('next_billing_date', optional: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /** @var SubscriptionStatus::*|null $status */
    #[Api(enum: SubscriptionStatus::class, optional: true)]
    public ?string $status;

    #[Api('tax_id', optional: true)]
    public ?string $taxID;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string>|null $metadata
     * @param SubscriptionStatus::* $status
     */
    public static function with(
        ?BillingAddress $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        ?DisableOnDemand $disableOnDemand = null,
        ?array $metadata = null,
        ?\DateTimeInterface $nextBillingDate = null,
        ?string $status = null,
        ?string $taxID = null,
    ): self {
        $obj = new self;

        null !== $billing && $obj->billing = $billing;
        null !== $cancelAtNextBillingDate && $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;
        null !== $disableOnDemand && $obj->disableOnDemand = $disableOnDemand;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $nextBillingDate && $obj->nextBillingDate = $nextBillingDate;
        null !== $status && $obj->status = $status;
        null !== $taxID && $obj->taxID = $taxID;

        return $obj;
    }

    public function withBilling(BillingAddress $billing): self
    {
        $obj = clone $this;
        $obj->billing = $billing;

        return $obj;
    }

    /**
     * When set, the subscription will remain active until the end of billing period.
     */
    public function withCancelAtNextBillingDate(
        ?bool $cancelAtNextBillingDate
    ): self {
        $obj = clone $this;
        $obj->cancelAtNextBillingDate = $cancelAtNextBillingDate;

        return $obj;
    }

    public function withDisableOnDemand(?DisableOnDemand $disableOnDemand): self
    {
        $obj = clone $this;
        $obj->disableOnDemand = $disableOnDemand;

        return $obj;
    }

    /**
     * @param array<string, string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $obj = clone $this;
        $obj->nextBillingDate = $nextBillingDate;

        return $obj;
    }

    /**
     * @param SubscriptionStatus::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    public function withTaxID(?string $taxID): self
    {
        $obj = clone $this;
        $obj->taxID = $taxID;

        return $obj;
    }
}
