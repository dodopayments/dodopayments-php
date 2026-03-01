<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-import-type CustomerLimitedDetailsShape from \Dodopayments\Payments\CustomerLimitedDetails
 *
 * @phpstan-type PaymentListResponseShape = array{
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   customer: CustomerLimitedDetails|CustomerLimitedDetailsShape,
 *   digitalProductsDelivered: bool,
 *   hasLicenseKey: bool,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   totalAmount: int,
 *   disputeStatus?: null|DisputeStatus|value-of<DisputeStatus>,
 *   invoiceID?: string|null,
 *   invoiceURL?: string|null,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   refundStatus?: null|PaymentRefundStatus|value-of<PaymentRefundStatus>,
 *   status?: null|IntentStatus|value-of<IntentStatus>,
 *   subscriptionID?: string|null,
 * }
 */
final class PaymentListResponse implements BaseModel
{
    /** @use SdkModel<PaymentListResponseShape> */
    use SdkModel;

    #[Required('brand_id')]
    public string $brandID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required]
    public CustomerLimitedDetails $customer;

    #[Required('digital_products_delivered')]
    public bool $digitalProductsDelivered;

    #[Required('has_license_key')]
    public bool $hasLicenseKey;

    /** @var array<string,string> $metadata */
    #[Required(map: 'string')]
    public array $metadata;

    #[Required('payment_id')]
    public string $paymentID;

    #[Required('total_amount')]
    public int $totalAmount;

    /**
     * The most recent dispute status for this payment. None if no disputes exist.
     *
     * @var value-of<DisputeStatus>|null $disputeStatus
     */
    #[Optional('dispute_status', enum: DisputeStatus::class, nullable: true)]
    public ?string $disputeStatus;

    /**
     * Invoice ID for this payment. Uses India-specific invoice ID if available.
     */
    #[Optional('invoice_id', nullable: true)]
    public ?string $invoiceID;

    /**
     * URL to download the invoice PDF for this payment.
     */
    #[Optional('invoice_url', nullable: true)]
    public ?string $invoiceURL;

    #[Optional('payment_method', nullable: true)]
    public ?string $paymentMethod;

    #[Optional('payment_method_type', nullable: true)]
    public ?string $paymentMethodType;

    /**
     * Summary of the refund status for this payment. None if no succeeded refunds exist.
     *
     * @var value-of<PaymentRefundStatus>|null $refundStatus
     */
    #[Optional('refund_status', enum: PaymentRefundStatus::class, nullable: true)]
    public ?string $refundStatus;

    /** @var value-of<IntentStatus>|null $status */
    #[Optional(enum: IntentStatus::class, nullable: true)]
    public ?string $status;

    #[Optional('subscription_id', nullable: true)]
    public ?string $subscriptionID;

    /**
     * `new PaymentListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentListResponse::with(
     *   brandID: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   digitalProductsDelivered: ...,
     *   hasLicenseKey: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentListResponse)
     *   ->withBrandID(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withDigitalProductsDelivered(...)
     *   ->withHasLicenseKey(...)
     *   ->withMetadata(...)
     *   ->withPaymentID(...)
     *   ->withTotalAmount(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     * @param array<string,string> $metadata
     * @param DisputeStatus|value-of<DisputeStatus>|null $disputeStatus
     * @param PaymentRefundStatus|value-of<PaymentRefundStatus>|null $refundStatus
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public static function with(
        string $brandID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digitalProductsDelivered,
        bool $hasLicenseKey,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        DisputeStatus|string|null $disputeStatus = null,
        ?string $invoiceID = null,
        ?string $invoiceURL = null,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        PaymentRefundStatus|string|null $refundStatus = null,
        IntentStatus|string|null $status = null,
        ?string $subscriptionID = null,
    ): self {
        $self = new self;

        $self['brandID'] = $brandID;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;
        $self['hasLicenseKey'] = $hasLicenseKey;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['totalAmount'] = $totalAmount;

        null !== $disputeStatus && $self['disputeStatus'] = $disputeStatus;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $invoiceURL && $self['invoiceURL'] = $invoiceURL;
        null !== $paymentMethod && $self['paymentMethod'] = $paymentMethod;
        null !== $paymentMethodType && $self['paymentMethodType'] = $paymentMethodType;
        null !== $refundStatus && $self['refundStatus'] = $refundStatus;
        null !== $status && $self['status'] = $status;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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

    /**
     * @param CustomerLimitedDetails|CustomerLimitedDetailsShape $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $self = clone $this;
        $self['digitalProductsDelivered'] = $digitalProductsDelivered;

        return $self;
    }

    public function withHasLicenseKey(bool $hasLicenseKey): self
    {
        $self = clone $this;
        $self['hasLicenseKey'] = $hasLicenseKey;

        return $self;
    }

    /**
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

        return $self;
    }

    /**
     * The most recent dispute status for this payment. None if no disputes exist.
     *
     * @param DisputeStatus|value-of<DisputeStatus>|null $disputeStatus
     */
    public function withDisputeStatus(
        DisputeStatus|string|null $disputeStatus
    ): self {
        $self = clone $this;
        $self['disputeStatus'] = $disputeStatus;

        return $self;
    }

    /**
     * Invoice ID for this payment. Uses India-specific invoice ID if available.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * URL to download the invoice PDF for this payment.
     */
    public function withInvoiceURL(?string $invoiceURL): self
    {
        $self = clone $this;
        $self['invoiceURL'] = $invoiceURL;

        return $self;
    }

    public function withPaymentMethod(?string $paymentMethod): self
    {
        $self = clone $this;
        $self['paymentMethod'] = $paymentMethod;

        return $self;
    }

    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $self = clone $this;
        $self['paymentMethodType'] = $paymentMethodType;

        return $self;
    }

    /**
     * Summary of the refund status for this payment. None if no succeeded refunds exist.
     *
     * @param PaymentRefundStatus|value-of<PaymentRefundStatus>|null $refundStatus
     */
    public function withRefundStatus(
        PaymentRefundStatus|string|null $refundStatus
    ): self {
        $self = clone $this;
        $self['refundStatus'] = $refundStatus;

        return $self;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
