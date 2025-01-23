<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class CreateOneTimePaymentRequest
{
    #[SerializedName('billing')]
    public BillingAddress $billing;

    #[SerializedName('customer')]
    public CustomerRequest $customer;

    #[SerializedName('metadata')]
    public ?array $metadata;

    /**
     * Whether to generate a payment link. Defaults to false if not specified.
     */
    #[SerializedName('payment_link')]
    public ?bool $paymentLink;

    /**
     * @var OneTimeProductCartItem[]
     * List of products in the cart. Must contain at least 1 and at most 100 items.
     */
    #[SerializedName('product_cart')]
    public array $productCart;

    /**
	 * Optional URL to redirect the customer after payment.
Must be a valid URL if provided.
	 */
    #[SerializedName('return_url')]
    public ?string $returnUrl;

    public function __construct(
        BillingAddress $billing,
        CustomerRequest $customer,
        ?array $metadata = [],
        ?bool $paymentLink = null,
        array $productCart,
        ?string $returnUrl = null
    ) {
        $this->billing = $billing;
        $this->customer = $customer;
        $this->metadata = $metadata;
        $this->paymentLink = $paymentLink;
        $this->productCart = $productCart;
        $this->returnUrl = $returnUrl;
    }
}
