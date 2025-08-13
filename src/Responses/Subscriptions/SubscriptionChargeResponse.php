<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Subscriptions;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type subscription_charge_response_alias = array{paymentID: string}
 */
final class SubscriptionChargeResponse implements BaseModel
{
    use Model;

    #[Api('payment_id')]
    public string $paymentID;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(string $paymentID): self
    {
        $obj = new self;

        $obj->paymentID = $paymentID;

        return $obj;
    }

    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }
}
