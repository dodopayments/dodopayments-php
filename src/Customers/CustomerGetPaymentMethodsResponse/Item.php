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
        $obj = new self;

        $obj['paymentMethod'] = $paymentMethod;
        $obj['paymentMethodID'] = $paymentMethodID;

        null !== $card && $obj['card'] = $card;
        null !== $lastUsedAt && $obj['lastUsedAt'] = $lastUsedAt;
        null !== $paymentMethodType && $obj['paymentMethodType'] = $paymentMethodType;
        null !== $recurringEnabled && $obj['recurringEnabled'] = $recurringEnabled;

        return $obj;
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
        $obj = clone $this;
        $obj['paymentMethod'] = $paymentMethod;

        return $obj;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $obj = clone $this;
        $obj['paymentMethodID'] = $paymentMethodID;

        return $obj;
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
        $obj = clone $this;
        $obj['card'] = $card;

        return $obj;
    }

    public function withLastUsedAt(?\DateTimeInterface $lastUsedAt): self
    {
        $obj = clone $this;
        $obj['lastUsedAt'] = $lastUsedAt;

        return $obj;
    }

    /**
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $paymentMethodType
     */
    public function withPaymentMethodType(
        PaymentMethodTypes|string|null $paymentMethodType
    ): self {
        $obj = clone $this;
        $obj['paymentMethodType'] = $paymentMethodType;

        return $obj;
    }

    public function withRecurringEnabled(?bool $recurringEnabled): self
    {
        $obj = clone $this;
        $obj['recurringEnabled'] = $recurringEnabled;

        return $obj;
    }
}
