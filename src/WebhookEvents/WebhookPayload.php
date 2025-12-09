<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\LicenseKeys\LicenseKeyStatus;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\Subscriptions\AddonCartResponseItem;
use Dodopayments\Subscriptions\Subscription\Meter;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\TimeInterval;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Dispute;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Payment\PayloadType;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Refund;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription;

/**
 * @phpstan-type WebhookPayloadShape = array{
 *   business_id: string,
 *   data: Payment|Subscription|Refund|Dispute|LicenseKey,
 *   timestamp: \DateTimeInterface,
 *   type: value-of<WebhookEventType>,
 * }
 */
final class WebhookPayload implements BaseModel
{
    /** @use SdkModel<WebhookPayloadShape> */
    use SdkModel;

    #[Required]
    public string $business_id;

    /**
     * The latest data at the time of delivery attempt.
     */
    #[Required]
    public Payment|Subscription|Refund|Dispute|LicenseKey $data;

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Event types for Dodo events.
     *
     * @var value-of<WebhookEventType> $type
     */
    #[Required(enum: WebhookEventType::class)]
    public string $type;

    /**
     * `new WebhookPayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookPayload::with(business_id: ..., data: ..., timestamp: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookPayload)
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
     * @param Payment|array{
     *   billing: BillingAddress,
     *   brand_id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digital_products_delivered: bool,
     *   disputes: list<\Dodopayments\Disputes\Dispute>,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refunds: list<\Dodopayments\Payments\Payment\Refund>,
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
     *   payload_type: value-of<PayloadType>,
     * }|Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     *   payload_type: value-of<Subscription\PayloadType>,
     * }|Refund|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   is_partial: bool,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payload_type: value-of<Refund\PayloadType>,
     * }|Dispute|array{
     *   amount: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: string,
     *   customer: CustomerLimitedDetails,
     *   dispute_id: string,
     *   dispute_stage: value-of<DisputeStage>,
     *   dispute_status: value-of<DisputeStatus>,
     *   payment_id: string,
     *   reason?: string|null,
     *   remarks?: string|null,
     *   payload_type: value-of<Dispute\PayloadType>,
     * }|LicenseKey|array{
     *   id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer_id: string,
     *   instances_count: int,
     *   key: string,
     *   payment_id: string,
     *   product_id: string,
     *   status: value-of<LicenseKeyStatus>,
     *   activations_limit?: int|null,
     *   expires_at?: \DateTimeInterface|null,
     *   subscription_id?: string|null,
     *   payload_type: value-of<LicenseKey\PayloadType>,
     * } $data
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public static function with(
        string $business_id,
        Payment|array|Subscription|Refund|Dispute|LicenseKey $data,
        \DateTimeInterface $timestamp,
        WebhookEventType|string $type,
    ): self {
        $obj = new self;

        $obj['business_id'] = $business_id;
        $obj['data'] = $data;
        $obj['timestamp'] = $timestamp;
        $obj['type'] = $type;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * The latest data at the time of delivery attempt.
     *
     * @param Payment|array{
     *   billing: BillingAddress,
     *   brand_id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   digital_products_delivered: bool,
     *   disputes: list<\Dodopayments\Disputes\Dispute>,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refunds: list<\Dodopayments\Payments\Payment\Refund>,
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
     *   payload_type: value-of<PayloadType>,
     * }|Subscription|array{
     *   addons: list<AddonCartResponseItem>,
     *   billing: BillingAddress,
     *   cancel_at_next_billing_date: bool,
     *   created_at: \DateTimeInterface,
     *   currency: value-of<Currency>,
     *   customer: CustomerLimitedDetails,
     *   metadata: array<string,string>,
     *   meters: list<Meter>,
     *   next_billing_date: \DateTimeInterface,
     *   on_demand: bool,
     *   payment_frequency_count: int,
     *   payment_frequency_interval: value-of<TimeInterval>,
     *   previous_billing_date: \DateTimeInterface,
     *   product_id: string,
     *   quantity: int,
     *   recurring_pre_tax_amount: int,
     *   status: value-of<SubscriptionStatus>,
     *   subscription_id: string,
     *   subscription_period_count: int,
     *   subscription_period_interval: value-of<TimeInterval>,
     *   tax_inclusive: bool,
     *   trial_period_days: int,
     *   cancelled_at?: \DateTimeInterface|null,
     *   discount_cycles_remaining?: int|null,
     *   discount_id?: string|null,
     *   expires_at?: \DateTimeInterface|null,
     *   payment_method_id?: string|null,
     *   tax_id?: string|null,
     *   payload_type: value-of<Subscription\PayloadType>,
     * }|Refund|array{
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer: CustomerLimitedDetails,
     *   is_partial: bool,
     *   metadata: array<string,string>,
     *   payment_id: string,
     *   refund_id: string,
     *   status: value-of<RefundStatus>,
     *   amount?: int|null,
     *   currency?: value-of<Currency>|null,
     *   reason?: string|null,
     *   payload_type: value-of<Refund\PayloadType>,
     * }|Dispute|array{
     *   amount: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   currency: string,
     *   customer: CustomerLimitedDetails,
     *   dispute_id: string,
     *   dispute_stage: value-of<DisputeStage>,
     *   dispute_status: value-of<DisputeStatus>,
     *   payment_id: string,
     *   reason?: string|null,
     *   remarks?: string|null,
     *   payload_type: value-of<Dispute\PayloadType>,
     * }|LicenseKey|array{
     *   id: string,
     *   business_id: string,
     *   created_at: \DateTimeInterface,
     *   customer_id: string,
     *   instances_count: int,
     *   key: string,
     *   payment_id: string,
     *   product_id: string,
     *   status: value-of<LicenseKeyStatus>,
     *   activations_limit?: int|null,
     *   expires_at?: \DateTimeInterface|null,
     *   subscription_id?: string|null,
     *   payload_type: value-of<LicenseKey\PayloadType>,
     * } $data
     */
    public function withData(
        Payment|array|Subscription|Refund|Dispute|LicenseKey $data
    ): self {
        $obj = clone $this;
        $obj['data'] = $data;

        return $obj;
    }

    /**
     * The timestamp of when the event occurred (not necessarily the same of when it was delivered).
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj['timestamp'] = $timestamp;

        return $obj;
    }

    /**
     * Event types for Dodo events.
     *
     * @param WebhookEventType|value-of<WebhookEventType> $type
     */
    public function withType(WebhookEventType|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }
}
