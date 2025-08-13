<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
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
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?BillingAddress $billing;

    #[Api('cancel_at_next_billing_date', optional: true)]
    public ?bool $cancelAtNextBillingDate;

    #[Api('disable_on_demand', optional: true)]
    public ?DisableOnDemand $disableOnDemand;

    /** @var null|array<string, string> $metadata */
    #[Api(type: new MapOf('string'), nullable: true, optional: true)]
    public ?array $metadata;

    #[Api('next_billing_date', optional: true)]
    public ?\DateTimeInterface $nextBillingDate;

    /** @var null|SubscriptionStatus::* $status */
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
     * @param null|array<string, string> $metadata
     * @param SubscriptionStatus::* $status
     */
    public static function from(
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

    public function setBilling(BillingAddress $billing): self
    {
        $this->billing = $billing;

        return $this;
    }

    public function setCancelAtNextBillingDate(
        ?bool $cancelAtNextBillingDate
    ): self {
        $this->cancelAtNextBillingDate = $cancelAtNextBillingDate;

        return $this;
    }

    public function setDisableOnDemand(?DisableOnDemand $disableOnDemand): self
    {
        $this->disableOnDemand = $disableOnDemand;

        return $this;
    }

    /**
     * @param null|array<string, string> $metadata
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function setNextBillingDate(
        ?\DateTimeInterface $nextBillingDate
    ): self {
        $this->nextBillingDate = $nextBillingDate;

        return $this;
    }

    /**
     * @param SubscriptionStatus::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setTaxID(?string $taxID): self
    {
        $this->taxID = $taxID;

        return $this;
    }
}
