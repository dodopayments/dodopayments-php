<?php

declare(strict_types=1);

namespace Dodopayments\Responses\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Conversion\MapOf;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\OneTimeProductCartItem;

/**
 * @phpstan-type payment_new_response_alias = array{
 *   clientSecret: string,
 *   customer: CustomerLimitedDetails,
 *   metadata: array<string, string>,
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
    use Model;

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    #[Api('client_secret')]
    public string $clientSecret;

    /**
     * Limited details about the customer making the payment.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Additional metadata associated with the payment.
     *
     * @var array<string, string> $metadata
     */
    #[Api(type: new MapOf('string'))]
    public array $metadata;

    /**
     * Unique identifier for the payment.
     */
    #[Api('payment_id')]
    public string $paymentID;

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    #[Api('total_amount')]
    public int $totalAmount;

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
     * Optional URL to a hosted payment page.
     */
    #[Api('payment_link', optional: true)]
    public ?string $paymentLink;

    /**
     * Optional list of products included in the payment.
     *
     * @var null|list<OneTimeProductCartItem> $productCart
     */
    #[Api(
        'product_cart',
        type: new ListOf(OneTimeProductCartItem::class),
        nullable: true,
        optional: true,
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, string> $metadata
     * @param null|list<OneTimeProductCartItem> $productCart
     */
    public static function with(
        string $clientSecret,
        CustomerLimitedDetails $customer,
        array $metadata,
        string $paymentID,
        int $totalAmount,
        ?string $discountID = null,
        ?\DateTimeInterface $expiresOn = null,
        ?string $paymentLink = null,
        ?array $productCart = null,
    ): self {
        $obj = new self;

        $obj->clientSecret = $clientSecret;
        $obj->customer = $customer;
        $obj->metadata = $metadata;
        $obj->paymentID = $paymentID;
        $obj->totalAmount = $totalAmount;

        null !== $discountID && $obj->discountID = $discountID;
        null !== $expiresOn && $obj->expiresOn = $expiresOn;
        null !== $paymentLink && $obj->paymentLink = $paymentLink;
        null !== $productCart && $obj->productCart = $productCart;

        return $obj;
    }

    /**
     * Client secret used to load Dodo checkout SDK
     * NOTE : Dodo checkout SDK will be coming soon.
     */
    public function withClientSecret(string $clientSecret): self
    {
        $obj = clone $this;
        $obj->clientSecret = $clientSecret;

        return $obj;
    }

    /**
     * Limited details about the customer making the payment.
     */
    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Additional metadata associated with the payment.
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
     * Unique identifier for the payment.
     */
    public function withPaymentID(string $paymentID): self
    {
        $obj = clone $this;
        $obj->paymentID = $paymentID;

        return $obj;
    }

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj->totalAmount = $totalAmount;

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
     * Optional URL to a hosted payment page.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj->paymentLink = $paymentLink;

        return $obj;
    }

    /**
     * Optional list of products included in the payment.
     *
     * @param null|list<OneTimeProductCartItem> $productCart
     */
    public function withProductCart(?array $productCart): self
    {
        $obj = clone $this;
        $obj->productCart = $productCart;

        return $obj;
    }
}
