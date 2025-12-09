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
 *   business_id: string,
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
    #[Required]
    public string $business_id;

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
     *   business_id: ..., data: ..., timestamp: ..., type: ...
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
     *   brand_id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digital_products_delivered: bool,
     *   disputes: list<Dispute>,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refunds: list<Refund>,
     *   settlement_amount: int,
     *   settlement_currency: value-of<Currency>,
     *   total_amount: int,
     *   card_issuing_country?: value-of<CountryCode>|null,
     *   card_last_four?: string|null,
     *   card_network?: string|null,
     *   card_type?: string|null,
     *   checkout_session_id?: string|null,
     *   discount_id?: string|null,
     *   error_code?: string|null,
     *   error_message?: string|null,
     *   payment_link?: string|null,
     *   payment_method?: string|null,
     *   payment_method_type?: string|null,
     *   product_cart?: list<ProductCart>|null,
     *   settlement_tax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscription_id?: string|null,
     *   tax?: int|null,
     *   updated_at?: \DateTimeInterface|null,
     *   payload_type?: value-of<PayloadType>|null,
     * } $data
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $business_id,
        Data|array $data,
        \DateTimeInterface $timestamp,
        Type|string $type,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
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
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Event-specific data.
     *
     * @param Data|array{
     *   billing: BillingAddress,
     *   brand_id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digital_products_delivered: bool,
     *   disputes: list<Dispute>,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refunds: list<Refund>,
     *   settlement_amount: int,
     *   settlement_currency: value-of<Currency>,
     *   total_amount: int,
     *   card_issuing_country?: value-of<CountryCode>|null,
     *   card_last_four?: string|null,
     *   card_network?: string|null,
     *   card_type?: string|null,
     *   checkout_session_id?: string|null,
     *   discount_id?: string|null,
     *   error_code?: string|null,
     *   error_message?: string|null,
     *   payment_link?: string|null,
     *   payment_method?: string|null,
     *   payment_method_type?: string|null,
     *   product_cart?: list<ProductCart>|null,
     *   settlement_tax?: int|null,
     *   status?: value-of<IntentStatus>|null,
     *   subscription_id?: string|null,
     *   tax?: int|null,
     *   updated_at?: \DateTimeInterface|null,
     *   payload_type?: value-of<PayloadType>|null,
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
