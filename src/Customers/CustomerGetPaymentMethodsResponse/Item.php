<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\Card;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\PaymentMethod;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-type ItemShape = array{
 *   payment_method: value-of<PaymentMethod>,
 *   payment_method_id: string,
 *   card?: Card|null,
 *   last_used_at?: \DateTimeInterface|null,
 *   payment_method_type?: value-of<PaymentMethodTypes>|null,
 *   recurring_enabled?: bool|null,
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
     * @var value-of<PaymentMethod> $payment_method
     */
    #[Api(enum: PaymentMethod::class)]
    public string $payment_method;

    #[Api]
    public string $payment_method_id;

    #[Api(nullable: true, optional: true)]
    public ?Card $card;

    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $last_used_at;

    /** @var value-of<PaymentMethodTypes>|null $payment_method_type */
    #[Api(enum: PaymentMethodTypes::class, nullable: true, optional: true)]
    public ?string $payment_method_type;

    #[Api(nullable: true, optional: true)]
    public ?bool $recurring_enabled;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(payment_method: ..., payment_method_id: ...)
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
     * @param PaymentMethod|value-of<PaymentMethod> $payment_method
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $payment_method_type
     */
    public static function with(
        PaymentMethod|string $payment_method,
        string $payment_method_id,
        ?Card $card = null,
        ?\DateTimeInterface $last_used_at = null,
        PaymentMethodTypes|string|null $payment_method_type = null,
        ?bool $recurring_enabled = null,
    ): self {
        $obj = new self;

        $obj['payment_method'] = $payment_method;
        $obj->payment_method_id = $payment_method_id;

        null !== $card && $obj->card = $card;
        null !== $last_used_at && $obj->last_used_at = $last_used_at;
        null !== $payment_method_type && $obj['payment_method_type'] = $payment_method_type;
        null !== $recurring_enabled && $obj->recurring_enabled = $recurring_enabled;

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
        $obj['payment_method'] = $paymentMethod;

        return $obj;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $obj = clone $this;
        $obj->payment_method_id = $paymentMethodID;

        return $obj;
    }

    public function withCard(?Card $card): self
    {
        $obj = clone $this;
        $obj->card = $card;

        return $obj;
    }

    public function withLastUsedAt(?\DateTimeInterface $lastUsedAt): self
    {
        $obj = clone $this;
        $obj->last_used_at = $lastUsedAt;

        return $obj;
    }

    /**
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $paymentMethodType
     */
    public function withPaymentMethodType(
        PaymentMethodTypes|string|null $paymentMethodType
    ): self {
        $obj = clone $this;
        $obj['payment_method_type'] = $paymentMethodType;

        return $obj;
    }

    public function withRecurringEnabled(?bool $recurringEnabled): self
    {
        $obj = clone $this;
        $obj->recurring_enabled = $recurringEnabled;

        return $obj;
    }
}
