<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\Existing;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod\New_;

/**
 * @see Dodopayments\Services\SubscriptionsService::updatePaymentMethod()
 *
 * @phpstan-import-type PaymentMethodVariants from \Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod
 * @phpstan-import-type PaymentMethodShape from \Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod
 *
 * @phpstan-type SubscriptionUpdatePaymentMethodParamsShape = array{
 *   paymentMethod: PaymentMethodShape
 * }
 */
final class SubscriptionUpdatePaymentMethodParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var PaymentMethodVariants $paymentMethod */
    #[Required(union: PaymentMethod::class)]
    public New_|Existing $paymentMethod;

    /**
     * `new SubscriptionUpdatePaymentMethodParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdatePaymentMethodParams::with(paymentMethod: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdatePaymentMethodParams)->withPaymentMethod(...)
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
     * @param PaymentMethodShape $paymentMethod
     */
    public static function with(New_|array|Existing $paymentMethod): self
    {
        $self = new self;

        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    /**
     * @param PaymentMethodShape $paymentMethod
     */
    public function withPaymentMethod(New_|array|Existing $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }
}
