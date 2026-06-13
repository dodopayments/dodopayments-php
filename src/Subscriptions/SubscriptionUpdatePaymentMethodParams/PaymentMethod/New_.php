<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\PaymentMethod;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-type NewShape = array{
 *   type: 'new',
 *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
 *   returnURL?: string|null,
 * }
 */
final class New_ implements BaseModel
{
    /** @use SdkModel<NewShape> */
    use SdkModel;

    /** @var 'new' $type */
    #[Required]
    public string $type = 'new';

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @var list<value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     */
    #[Optional(
        'allowed_payment_method_types',
        list: PaymentMethodTypes::class,
        nullable: true,
    )]
    public ?array $allowedPaymentMethodTypes;

    #[Optional('return_url', nullable: true)]
    public ?string $returnURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     */
    public static function with(
        ?array $allowedPaymentMethodTypes = null,
        ?string $returnURL = null
    ): self {
        $self = new self;

        null !== $allowedPaymentMethodTypes && $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;
        null !== $returnURL && $self['returnURL'] = $returnURL;

        return $self;
    }

    /**
     * @param 'new' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes
     */
    public function withAllowedPaymentMethodTypes(
        ?array $allowedPaymentMethodTypes
    ): self {
        $self = clone $this;
        $self['allowedPaymentMethodTypes'] = $allowedPaymentMethodTypes;

        return $self;
    }

    public function withReturnURL(?string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

        return $self;
    }
}
