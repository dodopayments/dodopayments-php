<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type SubscriptionNewResponseShape = array{
 *   addons: list<AddonCartResponseItem>,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   recurringPreTaxAmount: int,
 *   subscriptionID: string,
 *   clientSecret?: string|null,
 *   discountID?: string|null,
 *   expiresOn?: \DateTimeInterface|null,
 *   paymentLink?: string|null,
 * }
 */
final class SubscriptionNewResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionNewResponseShape> */
    use SdkModel;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Required(list: AddonCartResponseItem::class)]
    public array $addons;

    /**
     * Customer details associated with this subscription.
     */
    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * Additional metadata associated with the subscription.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * First payment id for the subscription.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    #[Required('recurring_pre_tax_amount')]
    public int $recurringPreTaxAmount;

    /**
     * Unique identifier for the subscription.
     */
    #[Required('subscription_id')]
    public string $subscriptionID;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Optional('client_secret', nullable: true)]
    public ?string $clientSecret;

    /**
     * The discount id if discount is applied.
     */
    #[Optional('discount_id', nullable: true)]
    public ?string $discountID;

    /**
     * Expiry timestamp of the payment link.
     */
    #[Optional('expires_on', nullable: true)]
    public ?\DateTimeInterface $expiresOn;

    /**
     * URL to checkout page.
     */
    #[Optional('payment_link', nullable: true)]
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
     * @param list<AddonCartResponseItem|array{addonID: string, quantity: int}> $addons
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     */
    public static function with(
        array $addons,
        CustomerLimitedDetails|array $customer,
        array $metadata,
        string $paymentID,
        int $recurringPreTaxAmount,
        string $subscriptionID,
        ?string $clientSecret = null,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresOn = null,
        ?string $paymentLink = null,
    ): self {
        $self = new self;

        $self['addons'] = $addons;
        $self['customer'] = $customer;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['recurringPreTaxAmount'] = $recurringPreTaxAmount;
        $self['subscriptionID'] = $subscriptionID;

        null !== $clientSecret && $self['clientSecret'] = $clientSecret;
        null !== $discountID && $self['discountID'] = $discountID;
        null !== $expiresOn && $self['expiresOn'] = $expiresOn;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * Addons associated with this subscription.
     *
     * @param list<AddonCartResponseItem|array{addonID: string, quantity: int}> $addons
     */
    public function withAddons(array $addons): self
    {
        $self = clone $this;
        $self['addons'] = $addons;

        return $self;
    }

    /**
     * Customer details associated with this subscription.
     *
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Additional metadata associated with the subscription.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * First payment id for the subscription.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    public function withRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $self = clone $this;
        $self['recurringPreTaxAmount'] = $recurringPreTaxAmount;

        return $self;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(?string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $self = clone $this;
        $self['discountID'] = $discountID;

        return $self;
    }

    /**
     * Expiry timestamp of the payment link.
     */
    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $self = clone $this;
        $self['expiresOn'] = $expiresOn;

        return $self;
    }

    /**
     * URL to checkout page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }
}
