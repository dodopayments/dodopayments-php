<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\Card;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\PaymentMethod;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-type ItemShape = array{
 *   paymentMethod: value-of<PaymentMethod>,
 *   paymentMethodID: string,
 *   card?: Card|null,
 *   lastUsedAt?: \DateTimeInterface|null,
 *   paymentMethodType?: value-of<PaymentMethodTypes>|null,
 *   recurringEnabled?: bool|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * PaymentMethod enum from hyperswitch.
     *
     * https://github.com/juspay/hyperswitch/blob/ecd05d53c99ae701ac94893ec632a3988afe3238/crates/common_enums/src/enums.rs#L2097
     *
     * @var value-of<PaymentMethod> $paymentMethod
     */
    #[Required('payment_method', enum: PaymentMethod::class)]
    public string $paymentMethod;

    #[Required('payment_method_id')]
    public string $paymentMethodID;

    #[Optional(nullable: true)]
    public ?Card $card;

    #[Optional('last_used_at', nullable: true)]
    public ?\DateTimeInterface $lastUsedAt;

    /** @var value-of<PaymentMethodTypes>|null $paymentMethodType */
    #[Optional(
        'payment_method_type',
        enum: PaymentMethodTypes::class,
        nullable: true
    )]
    public ?string $paymentMethodType;

    #[Optional('recurring_enabled', nullable: true)]
    public ?bool $recurringEnabled;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(paymentMethod: ..., paymentMethodID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withPaymentMethod(...)->withPaymentMethodID(...)
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
     * @param PaymentMethod|value-of<PaymentMethod> $paymentMethod
     * @param Card|array{
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   expiryMonth?: string|null,
     *   expiryYear?: string|null,
     *   last4Digits?: string|null,
     * }|null $card
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $paymentMethodType
     */
    public static function with(
        PaymentMethod|string $paymentMethod,
        string $paymentMethodID,
        Card|array|null $card = null,
        ?\DateTimeInterface $lastUsedAt = null,
        PaymentMethodTypes|string|null $paymentMethodType = null,
        ?bool $recurringEnabled = null,
    ): self {
        $self = new self;

        $self['paymentMethod'] = $paymentMethod;
        $self['paymentMethodID'] = $paymentMethodID;

        null !== $card && $self['card'] = $card;
        null !== $lastUsedAt && $self['lastUsedAt'] = $lastUsedAt;
        null !== $paymentMethodType && $self['paymentMethodType'] = $paymentMethodType;
        null !== $recurringEnabled && $self['recurringEnabled'] = $recurringEnabled;

        return $self;
    }

    /**
     * PaymentMethod enum from hyperswitch.
     *
     * https://github.com/juspay/hyperswitch/blob/ecd05d53c99ae701ac94893ec632a3988afe3238/crates/common_enums/src/enums.rs#L2097
     *
     * @param PaymentMethod|value-of<PaymentMethod> $paymentMethod
     */
    public function withPaymentMethod(PaymentMethod|string $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * @param Card|array{
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   expiryMonth?: string|null,
     *   expiryYear?: string|null,
     *   last4Digits?: string|null,
     * }|null $card
     */
    public function withCard(Card|array|null $card): self
    {
        $self = clone $this;
        $self['card'] = $card;

        return $self;
    }

    public function withLastUsedAt(?\DateTimeInterface $lastUsedAt): self
    {
        $self = clone $this;
        $self['lastUsedAt'] = $lastUsedAt;

        return $self;
    }

    /**
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $paymentMethodType
     */
    public function withPaymentMethodType(
        PaymentMethodTypes|string|null $paymentMethodType
    ): self {
        $self = clone $this;
        $self['paymentMethodType'] = $paymentMethodType;

        return $self;
    }

    public function withRecurringEnabled(?bool $recurringEnabled): self
    {
        $self = clone $this;
        $self['recurringEnabled'] = $recurringEnabled;

        return $self;
    }
}
