<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type SubscriptionNewResponseShape = array{
 *   addons: list<AddonCartResponseItem>,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   payment_id: string,
 *   recurring_pre_tax_amount: int,
 *   subscription_id: string,
 *   client_secret?: string|null,
 *   discount_id?: string|null,
 *   expires_on?: \DateTimeInterface|null,
 *   payment_link?: string|null,
 * }
 */
final class SubscriptionNewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<SubscriptionNewResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Api(list: AddonCartResponseItem::class)]
    public array $addons;

    /**
     * Customer details associated with this subscription.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Additional metadata associated with the subscription.
     *
     * @var array<string,string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * First payment id for the subscription.
     */
    #[Api]
    public string $payment_id;

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    #[Api]
    public int $recurring_pre_tax_amount;

    /**
     * Unique identifier for the subscription.
     */
    #[Api]
    public string $subscription_id;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $client_secret;

    /**
     * The discount id if discount is applied.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $discount_id;

    /**
     * Expiry timestamp of the payment link.
     */
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_on;

    /**
     * URL to checkout page.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $payment_link;

    /**
     * `new SubscriptionNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionNewResponse::with(
     *   addons: ...,
     *   customer: ...,
     *   metadata: ...,
     *   payment_id: ...,
     *   recurring_pre_tax_amount: ...,
     *   subscription_id: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionNewResponse)
     *   ->withAddons(...)
     *   ->withCustomer(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withRecurringPreTaxAmount(...)
     *   ->withSubscriptionID(...)
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
     * @param list<AddonCartResponseItem> $addons
     * @param array<string,string> $metadata
     */
    public static function with(
        array $addons,
        CustomerLimitedDetails $customer,
        array $metadata,
        string $payment_id,
        int $recurring_pre_tax_amount,
        string $subscription_id,
        ?string $client_secret = null,
        ?string $discount_id = null,
        ?\DateTimeInterface $expires_on = null,
        ?string $payment_link = null,
    ): self {
        $obj = new self;

        $obj->addons = $addons;
        $obj->customer = $customer;
        $obj->metadata = $metadata;
        $obj->payment_id = $payment_id;
        $obj->recurring_pre_tax_amount = $recurring_pre_tax_amount;
        $obj->subscription_id = $subscription_id;

        null !== $client_secret && $obj->client_secret = $client_secret;
        null !== $discount_id && $obj->discount_id = $discount_id;
        null !== $expires_on && $obj->expires_on = $expires_on;
        null !== $payment_link && $obj->payment_link = $payment_link;

        return $obj;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem> $addons
     */
    public function withAddons(array $addons): self
    {
        $obj = clone $this;
        $obj->addons = $addons;

        return $obj;
    }

    /**
     * Customer details associated with this subscription.
     */
    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Additional metadata associated with the subscription.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * First payment id for the subscription.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->payment_id = $paymentID;

        return $obj;
    }

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $obj = clone $this;
        $obj->recurring_pre_tax_amount = $recurringPreTaxAmount;

        return $obj;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscription_id = $subscriptionID;

        return $obj;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(?string $clientSecret): self
    {
        $obj = clone $this;
        $obj->client_secret = $clientSecret;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj->discount_id = $discountID;

        return $obj;
    }

    /**
     * Expiry timestamp of the payment link.
     */
    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $obj = clone $this;
        $obj->expires_on = $expiresOn;

        return $obj;
    }

    /**
     * URL to checkout page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj->payment_link = $paymentLink;

        return $obj;
    }
}
