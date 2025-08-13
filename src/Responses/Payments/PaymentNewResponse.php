<?php

declare(strict_types=1);

namespace DodoPayments\Responses\Payments;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\Core\Conversion\ListOf;
use DodoPayments\Core\Conversion\MapOf;
use DodoPayments\Payments\CustomerLimitedDetails;
use DodoPayments\Payments\OneTimeProductCartItem;

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
    public static function from(
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
    public function setClientSecret(string $clientSecret): self
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * Limited details about the customer making the payment.
     */
    public function setCustomer(CustomerLimitedDetails $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Additional metadata associated with the payment.
     *
     * @param array<string, string> $metadata
     */
    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Unique identifier for the payment.
     */
    public function setPaymentID(string $paymentID): self
    {
        $this->paymentID = $paymentID;

        return $this;
    }

    /**
     * Total amount of the payment in smallest currency unit (e.g. cents).
     */
    public function setTotalAmount(int $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

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
     * Optional URL to a hosted payment page.
     */
    public function setPaymentLink(?string $paymentLink): self
    {
        $this->paymentLink = $paymentLink;

        return $this;
    }

    /**
     * Optional list of products included in the payment.
     *
     * @param null|list<OneTimeProductCartItem> $productCart
     */
    public function setProductCart(?array $productCart): self
    {
        $this->productCart = $productCart;

        return $this;
    }
}
