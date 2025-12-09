<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type PaymentListResponseShape = array{
 *   brandID: string,
 *   createdAt: \DateTimeInterface,
 *   currency: value-of<Currency>,
 *   customer: CustomerLimitedDetails,
 *   digitalProductsDelivered: bool,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   totalAmount: int,
 *   paymentMethod?: string|null,
 *   paymentMethodType?: string|null,
 *   status?: value-of<IntentStatus>|null,
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

    /** @var array<string,string> $metadata */
    #[Required(map: 'string')]
    public array $metadata;

    #[Required('payment_id')]
    public string $paymentID;

    #[Required('total_amount')]
    public int $totalAmount;

    #[Optional('payment_method', nullable: true)]
    public ?string $paymentMethod;

    #[Optional('payment_method_type', nullable: true)]
    public ?string $paymentMethodType;

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
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public static function with(
        string $brandID,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        CustomerLimitedDetails|array $customer,
        bool $digitalProductsDelivered,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        IntentStatus|string|null $status = null,
        ?string $subscriptionID = null,
    ): self {
        $obj = new self;

        $obj['brandID'] = $brandID;
        $obj['createdAt'] = $createdAt;
        $obj['currency'] = $currency;
        $obj['customer'] = $customer;
        $obj['digitalProductsDelivered'] = $digitalProductsDelivered;
        $obj['metadata'] = $metadata;
        $obj['paymentID'] = $paymentID;
        $obj['totalAmount'] = $totalAmount;

        null !== $paymentMethod && $obj['paymentMethod'] = $paymentMethod;
        null !== $paymentMethodType && $obj['paymentMethodType'] = $paymentMethodType;
        null !== $status && $obj['status'] = $status;
        null !== $subscriptionID && $obj['subscriptionID'] = $subscriptionID;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brandID'] = $brandID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
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
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    public function withDigitalProductsDelivered(
        bool $digitalProductsDelivered
    ): self {
        $obj = clone $this;
        $obj['digitalProductsDelivered'] = $digitalProductsDelivered;

        return $obj;
    }

    /**
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['totalAmount'] = $totalAmount;

        return $obj;
    }

    public function withPaymentMethod(?string $paymentMethod): self
    {
        $obj = clone $this;
        $obj['paymentMethod'] = $paymentMethod;

        return $obj;
    }

    public function withPaymentMethodType(?string $paymentMethodType): self
    {
        $obj = clone $this;
        $obj['paymentMethodType'] = $paymentMethodType;

        return $obj;
    }

    /**
     * @param IntentStatus|value-of<IntentStatus>|null $status
     */
    public function withStatus(IntentStatus|string|null $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $obj = clone $this;
        $obj['subscriptionID'] = $subscriptionID;

        return $obj;
    }
}
