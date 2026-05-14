<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\SubscriptionsService::updatePaymentMethod()
 *
 * @phpstan-type SubscriptionUpdatePaymentMethodParamsShape = array{
 *   type: 'existing', returnURL?: string|null, paymentMethodID: string
 * }
 */
final class SubscriptionUpdatePaymentMethodParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var 'existing' $type */
    #[Required]
    public string $type = 'existing';

    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    #[Required('payment_method_id')]
    public string $paymentMethodID;

    /**
     * `new SubscriptionUpdatePaymentMethodParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdatePaymentMethodParams::with(paymentMethodID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdatePaymentMethodParams)->withPaymentMethodID(...)
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
    public static function with(
        string $paymentMethodID,
        ?string $returnURL = null
    ): self {
        $self = new self;

        $self['paymentMethodID'] = $paymentMethodID;

        null !== $returnURL && $self['returnURL'] = $returnURL;

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

    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }
}
