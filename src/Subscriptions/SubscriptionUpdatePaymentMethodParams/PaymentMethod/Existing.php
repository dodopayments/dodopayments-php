<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ExistingShape = array{paymentMethodID: string, type: 'existing'}
 */
final class Existing implements BaseModel
{
    /** @use SdkModel<ExistingShape> */
    use SdkModel;

    /** @var 'existing' $type */
    #[Required]
    public string $type = 'existing';

    #[Required('payment_method_id')]
    public string $paymentMethodID;

    /**
     * `new Existing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Existing::with(paymentMethodID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Existing)->withPaymentMethodID(...)
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
    public static function with(string $paymentMethodID): self
    {
        $self = new self;

        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * @param 'existing' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
