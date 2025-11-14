<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\Card;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\ConnectorPaymentMethod;
use Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item\PaymentMethod;

/**
 * @phpstan-type ItemShape = array{
 *   connector_payment_methods: array<string,ConnectorPaymentMethod>,
 *   payment_method: value-of<PaymentMethod>,
 *   payment_method_id: string,
 *   profile_map: array<string,string>,
 *   card?: Card|null,
 *   last_used_at?: \DateTimeInterface|null,
 *   recurring_enabled?: bool|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /** @var array<string,ConnectorPaymentMethod> $connector_payment_methods */
    #[Api(map: ConnectorPaymentMethod::class)]
    public array $connector_payment_methods;

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

    /** @var array<string,string> $profile_map */
    #[Api(map: 'string')]
    public array $profile_map;

    #[Api(nullable: true, optional: true)]
    public ?Card $card;

    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $last_used_at;

    #[Api(nullable: true, optional: true)]
    public ?bool $recurring_enabled;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   connector_payment_methods: ...,
     *   payment_method: ...,
     *   payment_method_id: ...,
     *   profile_map: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withConnectorPaymentMethods(...)
     *   ->withPaymentMethod(...)
     *   ->withPaymentMethodID(...)
     *   ->withProfileMap(...)
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
     * @param array<string,ConnectorPaymentMethod> $connector_payment_methods
     * @param PaymentMethod|value-of<PaymentMethod> $payment_method
     * @param array<string,string> $profile_map
     */
    public static function with(
        array $connector_payment_methods,
        PaymentMethod|string $payment_method,
        string $payment_method_id,
        array $profile_map,
        ?Card $card = null,
        ?\DateTimeInterface $last_used_at = null,
        ?bool $recurring_enabled = null,
    ): self {
        $obj = new self;

        $obj->connector_payment_methods = $connector_payment_methods;
        $obj['payment_method'] = $payment_method;
        $obj->payment_method_id = $payment_method_id;
        $obj->profile_map = $profile_map;

        null !== $card && $obj->card = $card;
        null !== $last_used_at && $obj->last_used_at = $last_used_at;
        null !== $recurring_enabled && $obj->recurring_enabled = $recurring_enabled;

        return $obj;
    }

    /**
     * @param array<string,ConnectorPaymentMethod> $connectorPaymentMethods
     */
    public function withConnectorPaymentMethods(
        array $connectorPaymentMethods
    ): self {
        $obj = clone $this;
        $obj->connector_payment_methods = $connectorPaymentMethods;

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

    /**
     * @param array<string,string> $profileMap
     */
    public function withProfileMap(array $profileMap): self
    {
        $obj = clone $this;
        $obj->profile_map = $profileMap;

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

    public function withRecurringEnabled(?bool $recurringEnabled): self
    {
        $obj = clone $this;
        $obj->recurring_enabled = $recurringEnabled;

        return $obj;
    }
}
