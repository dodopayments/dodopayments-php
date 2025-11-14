<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;

/**
 * @phpstan-type ConnectorPaymentMethodShape = array{
 *   connector_mandate_id: string,
 *   original_payment_authorized_amount: int,
 *   original_payment_authorized_currency: value-of<Currency>,
 *   payment_method_type?: value-of<PaymentMethodTypes>|null,
 * }
 */
final class ConnectorPaymentMethod implements BaseModel
{
    /** @use SdkModel<ConnectorPaymentMethodShape> */
    use SdkModel;

    #[Api]
    public string $connector_mandate_id;

    #[Api]
    public int $original_payment_authorized_amount;

    /** @var value-of<Currency> $original_payment_authorized_currency */
    #[Api(enum: Currency::class)]
    public string $original_payment_authorized_currency;

    /** @var value-of<PaymentMethodTypes>|null $payment_method_type */
    #[Api(enum: PaymentMethodTypes::class, nullable: true, optional: true)]
    public ?string $payment_method_type;

    /**
     * `new ConnectorPaymentMethod()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConnectorPaymentMethod::with(
     *   connector_mandate_id: ...,
     *   original_payment_authorized_amount: ...,
     *   original_payment_authorized_currency: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConnectorPaymentMethod)
     *   ->withConnectorMandateID(...)
     *   ->withOriginalPaymentAuthorizedAmount(...)
     *   ->withOriginalPaymentAuthorizedCurrency(...)
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
     * @param Currency|value-of<Currency> $original_payment_authorized_currency
     * @param PaymentMethodTypes|value-of<PaymentMethodTypes>|null $payment_method_type
     */
    public static function with(
        string $connector_mandate_id,
        int $original_payment_authorized_amount,
        Currency|string $original_payment_authorized_currency,
        PaymentMethodTypes|string|null $payment_method_type = null,
    ): self {
        $obj = new self;

        $obj->connector_mandate_id = $connector_mandate_id;
        $obj->original_payment_authorized_amount = $original_payment_authorized_amount;
        $obj['original_payment_authorized_currency'] = $original_payment_authorized_currency;

        null !== $payment_method_type && $obj['payment_method_type'] = $payment_method_type;

        return $obj;
    }

    public function withConnectorMandateID(string $connectorMandateID): self
    {
        $obj = clone $this;
        $obj->connector_mandate_id = $connectorMandateID;

        return $obj;
    }

    public function withOriginalPaymentAuthorizedAmount(
        int $originalPaymentAuthorizedAmount
    ): self {
        $obj = clone $this;
        $obj->original_payment_authorized_amount = $originalPaymentAuthorizedAmount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $originalPaymentAuthorizedCurrency
     */
    public function withOriginalPaymentAuthorizedCurrency(
        Currency|string $originalPaymentAuthorizedCurrency
    ): self {
        $obj = clone $this;
        $obj['original_payment_authorized_currency'] = $originalPaymentAuthorizedCurrency;

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
}
