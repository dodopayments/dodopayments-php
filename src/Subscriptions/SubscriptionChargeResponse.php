<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionChargeResponseShape = array{paymentID: string}
 */
final class SubscriptionChargeResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionChargeResponseShape> */
    use SdkModel;

    #[Required('payment_id')]
    public string $paymentID;

    /**
     * `new SubscriptionChargeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChargeResponse::with(paymentID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionChargeResponse)->withPaymentID(...)
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
     */
    public static function with(string $paymentID): self
    {
        $self = new self;

        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }
}
