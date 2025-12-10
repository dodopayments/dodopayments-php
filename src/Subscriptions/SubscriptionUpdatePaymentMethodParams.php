<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\Type;

/**
 * @see Dodopayments\Services\SubscriptionsService::updatePaymentMethod()
 *
 * @phpstan-type SubscriptionUpdatePaymentMethodParamsShape = array{
 *   type: Type|value-of<Type>, returnURL?: string|null, paymentMethodID: string
 * }
 */
final class SubscriptionUpdatePaymentMethodParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    #[Required('payment_method_id')]
    public string $paymentMethodID;

    /**
     * `new SubscriptionUpdatePaymentMethodParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdatePaymentMethodParams::with(type: ..., paymentMethodID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdatePaymentMethodParams)
     *   ->withType(...)
     *   ->withPaymentMethodID(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        string $paymentMethodID,
        ?string $returnURL = null
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['paymentMethodID'] = $paymentMethodID;

        null !== $returnURL && $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
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
