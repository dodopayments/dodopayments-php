<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Payments\Payment\Refund;
use Dodopayments\Webhooks\PaymentFailedWebhookEvent\Data;
use Dodopayments\Webhooks\PaymentFailedWebhookEvent\Data\PayloadType;
use Dodopayments\Webhooks\PaymentFailedWebhookEvent\Type;

/**
 * @phpstan-type PaymentFailedWebhookEventShape = array{
 *   businessID: string,
 *   data: Data,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<Type>,
 * }
 */
final class PaymentFailedWebhookEvent implements BaseModel
{
    /** @use SdkModel<PaymentFailedWebhookEventShape> */
    use SdkModel;

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Event-specific data.
     */
    #[Required]
    public Data $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * The event type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new PaymentFailedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentFailedWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentFailedWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
     *   ->withType(...)
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
     * @param Data|array{
     *   billing: BillingAddress,
     *   brandID: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digitalProductsDelivered: bool,
     *   disputes: list<Dispute>,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refunds: list<Refund>,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardLastFour?: string|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   checkoutSessionID?: string|null,
     *   discountID?: string|null,
     *   errorCode?: string|null,
     *   errorMessage?: string|null,
     *   paymentLink?: string|null,
     *   paymentMethod?: string|null,
     *   paymentMethodType?: string|null,
     *   productCart?: list<ProductCart>|null,
     *   settlementTax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscriptionID?: string|null,
     *   tax?: int|null,
     *   updatedAt?: \DateTimeInterface|null,
     *   payloadType?: value-of<PayloadType>|null,
     * } $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $businessID,
        Data|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj['businessID'] = $businessID;
        $obj['data'] = $data;
        $obj['timestamp'] = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     *
     * @param Data|array{
     *   billing: BillingAddress,
     *   brandID: string,
     *   businessID: string,
     *   createdAt: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digitalProductsDelivered: bool,
     *   disputes: list<Dispute>,
     *   metadata: array<string,string>,
     *   paymentID: string,
     *   refunds: list<Refund>,
     *   settlementAmount: int,
     *   settlementCurrency: value-of<Currency>,
     *   totalAmount: int,
     *   cardIssuingCountry?: value-of<CountryCode>|null,
     *   cardLastFour?: string|null,
     *   cardNetwork?: string|null,
     *   cardType?: string|null,
     *   checkoutSessionID?: string|null,
     *   discountID?: string|null,
     *   errorCode?: string|null,
     *   errorMessage?: string|null,
     *   paymentLink?: string|null,
     *   paymentMethod?: string|null,
     *   paymentMethodType?: string|null,
     *   productCart?: list<ProductCart>|null,
     *   settlementTax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscriptionID?: string|null,
     *   tax?: int|null,
     *   updatedAt?: \DateTimeInterface|null,
     *   payloadType?: value-of<PayloadType>|null,
     * } $data
     */
    public function withData(Data|array $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }

    /**
     * The event type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
