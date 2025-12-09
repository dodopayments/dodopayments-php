<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionChargeResponseShape = array{payment_id: string}
 */
final class SubscriptionChargeResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionChargeResponseShape> */
    use SdkModel;

    #[Api]
    public string $payment_id;

    /**
     * `new SubscriptionChargeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionChargeResponse::with(payment_id: ...)
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
    public static function with(string $payment_id): self
    {
        $obj = new self;

        $obj['payment_id'] = $payment_id;

        return $obj;
    }

    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }
}
