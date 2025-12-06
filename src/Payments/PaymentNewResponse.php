<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type PaymentNewResponseShape = array{
 *   client_secret: string,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string,string>,
 *   payment_id: string,
 *   total_amount: int,
 *   discount_id?: string|null,
 *   expires_on?: \DateTimeInterface|null,
 *   payment_link?: string|null,
 *   product_cart?: list<OneTimeProductCartItem>|null,
 * }
 */
final class PaymentNewResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<PaymentNewResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Api]
    public string $client_secret;

    /**
     * Limited details about the customer making the payment.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Additional metadata associated with the payment.
     *
     * @var array<string,string> $metadata
     */
    #[Api(map: 'string')]
    public array $metadata;

    /**
     * Unique identifier for the payment.
     */
    #[Api]
    public string $payment_id;

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    #[Api]
    public int $total_amount;

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
     * Optional URL to a hosted payment page.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $payment_link;

    /**
     * Optional list of products included in the payment.
     *
     * @var list<OneTimeProductCartItem>|null $product_cart
     */
    #[Api(list: OneTimeProductCartItem::class, nullable: true, optional: true)]
    public ?array $product_cart;

    /**
     * `new PaymentNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentNewResponse::with(
     *   client_secret: ...,
     *   customer: ...,
     *   metadata: ...,
     *   payment_id: ...,
     *   total_amount: ...,
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
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     * @param array<string,string> $metadata
     * @param list<OneTimeProductCartItem|array{
     *   product_id: string, quantity: int, amount?: int|null
     * }>|null $product_cart
     */
    public static function with(
        string $client_secret,
        CustomerLimitedDetails|array $customer,
        array $metadata,
        string $payment_id,
        int $total_amount,
        ?string $discount_id = null,
        ?\DateTimeInterface $expires_on = null,
        ?string $payment_link = null,
        ?array $product_cart = null,
    ): self {
        $obj = new self;

        $obj['client_secret'] = $client_secret;
        $obj['customer'] = $customer;
        $obj['metadata'] = $metadata;
        $obj['payment_id'] = $payment_id;
        $obj['total_amount'] = $total_amount;

        null !== $discount_id && $obj['discount_id'] = $discount_id;
        null !== $expires_on && $obj['expires_on'] = $expires_on;
        null !== $payment_link && $obj['payment_link'] = $payment_link;
        null !== $product_cart && $obj['product_cart'] = $product_cart;

        return $obj;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(string $clientSecret): self
    {
        $obj = clone $this;
        $obj['client_secret'] = $clientSecret;

        return $obj;
    }

    /**
     * Limited details about the customer making the payment.
     *
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    /**
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['total_amount'] = $totalAmount;

        return $obj;
    }

    /**
     * The discount id if discount is applied.
     */
    public function withDiscountID(?string $discountID): self
    {
        $obj = clone $this;
        $obj['discount_id'] = $discountID;

        return $obj;
    }

    /**
     * Expiry timestamp of the payment link.
     */
    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $obj = clone $this;
        $obj['expires_on'] = $expiresOn;

        return $obj;
    }

    /**
     * Optional URL to a hosted payment page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj['payment_link'] = $paymentLink;

        return $obj;
    }

    /**
     * Optional list of products included in the payment.
     *
     * @param list<OneTimeProductCartItem|array{
     *   product_id: string, quantity: int, amount?: int|null
     * }>|null $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $obj = clone $this;
        $obj['product_cart'] = $productCart;

        return $obj;
    }
}
