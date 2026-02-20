<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\CreditBalanceLow\PayloadType;

/**
 * @phpstan-type CreditBalanceLowShape = array{
 *   availableBalance: string,
 *   creditEntitlementID: string,
 *   creditEntitlementName: string,
 *   customerID: string,
 *   payloadType: PayloadType|value-of<PayloadType>,
 *   subscriptionCreditsAmount: string,
 *   subscriptionID: string,
 *   thresholdAmount: string,
 *   thresholdPercent: int,
 * }
 */
final class CreditBalanceLow implements BaseModel
{
    /** @use SdkModel<CreditBalanceLowShape> */
    use SdkModel;

    #[Required('available_balance')]
    public string $availableBalance;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('credit_entitlement_name')]
    public string $creditEntitlementName;

    #[Required('customer_id')]
    public string $customerID;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    #[Required('subscription_credits_amount')]
    public string $subscriptionCreditsAmount;

    #[Required('subscription_id')]
    public string $subscriptionID;

    #[Required('threshold_amount')]
    public string $thresholdAmount;

    #[Required('threshold_percent')]
    public int $thresholdPercent;

    /**
     * `new CreditBalanceLow()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditBalanceLow::with(
     *   availableBalance: ...,
     *   creditEntitlementID: ...,
     *   creditEntitlementName: ...,
     *   customerID: ...,
     *   payloadType: ...,
     *   subscriptionCreditsAmount: ...,
     *   subscriptionID: ...,
     *   thresholdAmount: ...,
     *   thresholdPercent: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditBalanceLow)
     *   ->withAvailableBalance(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCreditEntitlementName(...)
     *   ->withCustomerID(...)
     *   ->withPayloadType(...)
     *   ->withSubscriptionCreditsAmount(...)
     *   ->withSubscriptionID(...)
     *   ->withThresholdAmount(...)
     *   ->withThresholdPercent(...)
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
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(
        string $availableBalance,
        string $creditEntitlementID,
        string $creditEntitlementName,
        string $customerID,
        PayloadType|string $payloadType,
        string $subscriptionCreditsAmount,
        string $subscriptionID,
        string $thresholdAmount,
        int $thresholdPercent,
    ): self {
        $self = new self;

        $self['availableBalance'] = $availableBalance;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['creditEntitlementName'] = $creditEntitlementName;
        $self['customerID'] = $customerID;
        $self['payloadType'] = $payloadType;
        $self['subscriptionCreditsAmount'] = $subscriptionCreditsAmount;
        $self['subscriptionID'] = $subscriptionID;
        $self['thresholdAmount'] = $thresholdAmount;
        $self['thresholdPercent'] = $thresholdPercent;

        return $self;
    }

    public function withAvailableBalance(string $availableBalance): self
    {
        $self = clone $this;
        $self['availableBalance'] = $availableBalance;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCreditEntitlementName(
        string $creditEntitlementName
    ): self {
        $self = clone $this;
        $self['creditEntitlementName'] = $creditEntitlementName;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }

    public function withSubscriptionCreditsAmount(
        string $subscriptionCreditsAmount
    ): self {
        $self = clone $this;
        $self['subscriptionCreditsAmount'] = $subscriptionCreditsAmount;

        return $self;
    }

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    public function withThresholdAmount(string $thresholdAmount): self
    {
        $self = clone $this;
        $self['thresholdAmount'] = $thresholdAmount;

        return $self;
    }

    public function withThresholdPercent(int $thresholdPercent): self
    {
        $self = clone $this;
        $self['thresholdPercent'] = $thresholdPercent;

        return $self;
    }
}
