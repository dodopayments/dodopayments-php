<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\CollectionMethod;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\SubscriptionStartTrialParams\BillingAddress;
use Dodopayments\Subscriptions\SubscriptionStartTrialParams\PaymentTerms;
use Dodopayments\Subscriptions\SubscriptionStartTrialParams\PaymentTerms\DueOnReceipt;
use Dodopayments\Subscriptions\SubscriptionStartTrialParams\PaymentTerms\Net;

/**
 * Creates an invoice-led subscription and a paid $0 invoice for the trial.
 * The first invoice after the trial bills at `trial_ends_at`.
 *
 * @see Dodopayments\Services\SubscriptionsService::startTrial()
 *
 * @phpstan-import-type PaymentTermsVariants from \Dodopayments\Subscriptions\SubscriptionStartTrialParams\PaymentTerms
 * @phpstan-import-type BillingAddressShape from \Dodopayments\Subscriptions\SubscriptionStartTrialParams\BillingAddress
 * @phpstan-import-type PaymentTermsShape from \Dodopayments\Subscriptions\SubscriptionStartTrialParams\PaymentTerms
 *
 * @phpstan-type SubscriptionStartTrialParamsShape = array{
 *   collectionMethod: CollectionMethod|value-of<CollectionMethod>,
 *   currency: Currency|value-of<Currency>,
 *   customerID: string,
 *   productID: string,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   paymentMethodID?: string|null,
 *   paymentTerms?: PaymentTermsShape|null,
 *   quantity?: int|null,
 *   reviewRequired?: bool|null,
 *   taxID?: string|null,
 *   trialPeriodDays?: int|null,
 *   idempotencyKey?: string|null,
 * }
 */
final class SubscriptionStartTrialParams implements BaseModel
{
    /** @use SdkModel<SubscriptionStartTrialParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<CollectionMethod> $collectionMethod */
    #[Required('collection_method', enum: CollectionMethod::class)]
    public string $collectionMethod;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('customer_id')]
    public string $customerID;

    /**
     * A recurring product.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * The billing address of an invoice request.
     */
    #[Optional('billing_address', nullable: true)]
    public ?BillingAddress $billingAddress;

    /**
     * A saved card of the customer. Automatic charge needs it.
     */
    #[Optional('payment_method_id', nullable: true)]
    public ?string $paymentMethodID;

    /**
     * The terms of the invoices after the trial.
     *
     * @var PaymentTermsVariants|null $paymentTerms
     */
    #[Optional('payment_terms', union: PaymentTerms::class, nullable: true)]
    public DueOnReceipt|Net|null $paymentTerms;

    #[Optional]
    public ?int $quantity;

    /**
     * `true` keeps each renewal draft for review before it finalises.
     */
    #[Optional('review_required')]
    public ?bool $reviewRequired;

    #[Optional('tax_id', nullable: true)]
    public ?string $taxID;

    /**
     * 1 to 730 days. When this is not set, the product trial applies and the trial misuse check runs.
     */
    #[Optional('trial_period_days', nullable: true)]
    public ?int $trialPeriodDays;

    #[Optional]
    public ?string $idempotencyKey;

    /**
     * `new SubscriptionStartTrialParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionStartTrialParams::with(
     *   collectionMethod: ..., currency: ..., customerID: ..., productID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionStartTrialParams)
     *   ->withCollectionMethod(...)
     *   ->withCurrency(...)
     *   ->withCustomerID(...)
     *   ->withProductID(...)
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
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     * @param Currency|value-of<Currency> $currency
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param PaymentTermsShape|null $paymentTerms
     */
    public static function with(
        CollectionMethod|string $collectionMethod,
        Currency|string $currency,
        string $customerID,
        string $productID,
        BillingAddress|array|null $billingAddress = null,
        ?string $paymentMethodID = null,
        DueOnReceipt|array|Net|null $paymentTerms = null,
        ?int $quantity = null,
        ?bool $reviewRequired = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
        ?string $idempotencyKey = null,
    ): self {
        $self = new self;

        $self['collectionMethod'] = $collectionMethod;
        $self['currency'] = $currency;
        $self['customerID'] = $customerID;
        $self['productID'] = $productID;

        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $paymentMethodID && $self['paymentMethodID'] = $paymentMethodID;
        null !== $paymentTerms && $self['paymentTerms'] = $paymentTerms;
        null !== $quantity && $self['quantity'] = $quantity;
        null !== $reviewRequired && $self['reviewRequired'] = $reviewRequired;
        null !== $taxID && $self['taxID'] = $taxID;
        null !== $trialPeriodDays && $self['trialPeriodDays'] = $trialPeriodDays;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    /**
     * @param CollectionMethod|value-of<CollectionMethod> $collectionMethod
     */
    public function withCollectionMethod(
        CollectionMethod|string $collectionMethod
    ): self {
        $self = clone $this;
        $self['collectionMethod'] = $collectionMethod;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * A recurring product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * The billing address of an invoice request.
     *
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array|null $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * A saved card of the customer. Automatic charge needs it.
     */
    public function withPaymentMethodID(?string $paymentMethodID): self
    {
        $self = clone $this;
        $self['paymentMethodID'] = $paymentMethodID;

        return $self;
    }

    /**
     * The terms of the invoices after the trial.
     *
     * @param PaymentTermsShape|null $paymentTerms
     */
    public function withPaymentTerms(
        DueOnReceipt|array|Net|null $paymentTerms
    ): self {
        $self = clone $this;
        $self['paymentTerms'] = $paymentTerms;

        return $self;
    }

    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * `true` keeps each renewal draft for review before it finalises.
     */
    public function withReviewRequired(bool $reviewRequired): self
    {
        $self = clone $this;
        $self['reviewRequired'] = $reviewRequired;

        return $self;
    }

    public function withTaxID(?string $taxID): self
    {
        $self = clone $this;
        $self['taxID'] = $taxID;

        return $self;
    }

    /**
     * 1 to 730 days. When this is not set, the product trial applies and the trial misuse check runs.
     */
    public function withTrialPeriodDays(?int $trialPeriodDays): self
    {
        $self = clone $this;
        $self['trialPeriodDays'] = $trialPeriodDays;

        return $self;
    }

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }
}
