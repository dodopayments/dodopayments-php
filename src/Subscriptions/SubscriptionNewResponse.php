<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type subscription_new_response = array{
 *   addons: list<AddonCartResponseItem>,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string, string>,
 *   paymentID: string,
 *   recurringPreTaxAmount: int,
 *   subscriptionID: string,
 *   clientSecret?: string|null,
 *   discountID?: string|null,
 *   expiresOn?: \DateTimeInterface|null,
 *   paymentLink?: string|null,
 * }
 * When used in a response, this type parameter can be used to define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class SubscriptionNewResponse implements BaseModel
{
    /** @use SdkModel<subscription_new_response> */
    use SdkModel;

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
     * @var array<string, string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * First payment id for the subscription.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    #[Api('recurring_pre_tax_amount')]
    public int $recurringPreTaxAmount;

    /**
     * Unique identifier for the subscription.
     */
    #[Api('subscription_id')]
    public string $subscriptionID;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Api('client_secret', nullable: true, optional: true)]
    public ?string $clientSecret;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', nullable: true, optional: true)]
    public ?string $discountID;

    /**
     * Expiry timestamp of the payment link.
     */
    #[Api('expires_on', nullable: true, optional: true)]
    public ?\DateTimeInterface $expiresOn;

    /**
     * URL to checkout page.
     */
    #[Api('payment_link', nullable: true, optional: true)]
    public ?string $paymentLink;

    /**
     * `new SubscriptionNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionNewResponse::with(
     *   addons: ...,
     *   customer: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   recurringPreTaxAmount: ...,
     *   subscriptionID: ...,
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
     * @param array<string, string> $metadata
     */
    public static function with(
        array $addons,
        CustomerLimitedDetails $customer,
        array $metadata,
        string $paymentID,
        int $recurringPreTaxAmount,
        string $subscriptionID,
        ?string $clientSecret = null,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresOn = null,
        ?string $paymentLink = null,
    ): self {
        $obj = new self;

        $obj->addons = $addons;
        $obj->customer = $customer;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->recurringPreTaxAmount = $recurringPreTaxAmount;
        $obj->subscriptionID = $subscriptionID;

        null !== $clientSecret && $obj->clientSecret = $clientSecret;
        null !== $discountID && $obj->discountID = $discountID;
        null !== $expiresOn && $obj->expiresOn = $expiresOn;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;

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
     * @param array<string, string> $metadata
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
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $obj = clone $this;
        $obj->recurringPreTaxAmount = $recurringPreTaxAmount;

        return $obj;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $obj = clone $this;
        $obj->subscriptionID = $subscriptionID;

        return $obj;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(?string $clientSecret): self
    {
        $obj = clone $this;
        $obj->clientSecret = $clientSecret;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj->discountID = $discountID;

        return $obj;
    }

    /**
     * Expiry timestamp of the payment link.
     */
    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $obj = clone $this;
        $obj->expiresOn = $expiresOn;

        return $obj;
    }

    /**
     * URL to checkout page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj->paymentLink = $paymentLink;

        return $obj;
    }
}
