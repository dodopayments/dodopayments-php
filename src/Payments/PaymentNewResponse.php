<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaymentNewResponseShape = array{
 *   clientSecret: string,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   paymentID: string,
 *   totalAmount: int,
 *   discountID?: string|null,
 *   expiresOn?: \DateTimeInterface|null,
 *   paymentLink?: string|null,
 *   productCart?: list<OneTimeProductCartItem>|null,
 * }
 */
final class PaymentNewResponse implements BaseModel
{
    /** @use SdkModel<PaymentNewResponseShape> */
    use SdkModel;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Required('client_secret')]
    public string $clientSecret;

    /**
     * Limited details about the customer making the payment.
     */
    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * Additional metadata associated with the payment.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the payment.
     */
    #[Required('payment_id')]
    public string $paymentID;

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    #[Required('total_amount')]
    public int $totalAmount;

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
     * Optional URL to a hosted payment page.
     */
    #[Optional('payment_link', nullable: true)]
    public ?string $paymentLink;

    /**
     * Optional list of products included in the payment.
     *
     * @var list<OneTimeProductCartItem>|null $productCart
     */
    #[Optional(
        'product_cart',
        list: OneTimeProductCartItem::class,
        nullable: true
    )]
    public ?array $productCart;

    /**
     * `new PaymentNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentNewResponse::with(
     *   clientSecret: ...,
     *   customer: ...,
     *   metadata: ...,
     *   paymentID: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentNewResponse)
     *   ->withClientSecret(...)
     *   ->withCustomer(...)
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
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param list<OneTimeProductCartItem|array{
     *   productID: string, quantity: int, amount?: int|null
     * }>|null $productCart
     */
    public static function with(
        string $clientSecret,
        CustomerLimitedDetails|array $customer,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresOn = null,
        ?string $paymentLink = null,
        ?array $productCart = null,
    ): self {
        $self = new self;

        $self['clientSecret'] = $clientSecret;
        $self['customer'] = $customer;
        $self['metadata'] = $metadata;
        $self['paymentID'] = $paymentID;
        $self['totalAmount'] = $totalAmount;

        null !== $discountID && $self['discountID'] = $discountID;
        null !== $expiresOn && $self['expiresOn'] = $expiresOn;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $productCart && $self['productCart'] = $productCart;

        return $self;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    /**
     * Limited details about the customer making the payment.
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
     * Additional metadata associated with the payment.
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
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $self = clone $this;
        $self['totalAmount'] = $totalAmount;

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
     * Optional URL to a hosted payment page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * Optional list of products included in the payment.
     *
     * @param list<OneTimeProductCartItem|array{
     *   productID: string, quantity: int, amount?: int|null
     * }>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $self = clone $this;
        $self['productCart'] = $productCart;

        return $self;
    }
}
