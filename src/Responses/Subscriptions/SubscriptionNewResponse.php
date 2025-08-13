<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Subscriptions;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Payments\CustomerLimitedDetails;
use DodoPayments\Subscriptions\AddonCartResponseItem;

/**
 * @phpstan-type subscription_new_response_alias = array{
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
 */
final class SubscriptionNewResponse implements BaseModel
{
    use Model;

    /**
     * Addons associated with this subscription.
     *
     * @var list<AddonCartResponseItem> $addons
     */
    #[Api(type: new ListOf(AddonCartResponseItem::class))]
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
    #[Api(type: new MapOf('string'))]
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
    #[Api('client_secret', optional: true)]
    public ?string $clientSecret;

    /**
     * The discount id if discount is applied.
     */
    #[Api('discount_id', optional: true)]
    public ?string $discountID;

    /**
     * Expiry timestamp of the payment link.
     */
    #[Api('expires_on', optional: true)]
    public ?\DateTimeInterface $expiresOn;

    /**
     * URL to checkout page.
     */
    #[Api('payment_link', optional: true)]
    public ?string $paymentLink;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AddonCartResponseItem> $addons
     * @param array<string, string> $metadata
     */
    public static function from(
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
    public function setAddons(array $addons): self
    {
        $this->addons = $addons;

        return $this;
    }

    /**
     * Customer details associated with this subscription.
     */
    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Additional metadata associated with the subscription.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * First payment id for the subscription.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * Tax will be added to the amount and charged to the customer on each billing cycle.
     */
    public function setRecurringPreTaxAmount(int $recurringPreTaxAmount): self
    {
        $this->recurringPreTaxAmount = $recurringPreTaxAmount;

        return $this;
    }

    /**
     * Unique identifier for the subscription.
     */
    public function setSubscriptionID(string $subscriptionID): self
    {
        $this->subscriptionID = $subscriptionID;

        return $this;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function setClientSecret(?string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * The discount id if discount is applied.
     */
    public function setDiscountID(?string $discountID): self
    {
        $this->discountID = $discountID;

        return $this;
    }

    /**
     * Expiry timestamp of the payment link.
     */
    public function setExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $this->expiresOn = $expiresOn;

        return $this;
    }

    /**
     * URL to checkout page.
     */
    public function setPaymentLink(?string $paymentLink): self
    {
        $this->paymentLink = $paymentLink;

        return $this;
    }
}
