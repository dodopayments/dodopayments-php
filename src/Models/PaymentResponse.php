<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PaymentResponse
{
    /**
     * Identifier of the business associated with the payment
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * Timestamp when the payment was created
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    #[SerializedName('currency')]
    public Currency $currency;

    #[SerializedName('customer')]
    public CustomerLimitedDetailsResponse $customer;

    /**
     * @var DisputeResponse[]
     * List of disputes associated with this payment
     */
    #[SerializedName('disputes')]
    public array $disputes;

    /**
     * An error message if the payment failed
     */
    #[SerializedName('error_message')]
    public ?string $errorMessage;

    #[SerializedName('metadata')]
    public array $metadata;

    /**
     * Unique identifier for the payment
     */
    #[SerializedName('payment_id')]
    public string $paymentId;

    /**
     * Checkout URL
     */
    #[SerializedName('payment_link')]
    public ?string $paymentLink;

    /**
     * Payment method used by customer (e.g. "card", "bank_transfer")
     */
    #[SerializedName('payment_method')]
    public ?string $paymentMethod;

    /**
     * Specific type of payment method (e.g. "visa", "mastercard")
     */
    #[SerializedName('payment_method_type')]
    public ?string $paymentMethodType;

    /**
     * @var OneTimeProductCartItemResponse[]|null
     * List of products purchased in a one-time payment
     */
    #[SerializedName('product_cart')]
    public ?array $productCart;

    /**
     * @var RefundResponse[]
     * List of refunds issued for this payment
     */
    #[SerializedName('refunds')]
    public array $refunds;

    #[SerializedName('status')]
    public ?IntentStatus $status;

    /**
     * Identifier of the subscription if payment is part of a subscription
     */
    #[SerializedName('subscription_id')]
    public ?string $subscriptionId;

    /**
     * Amount of tax collected in smallest currency unit (e.g. cents)
     */
    #[SerializedName('tax')]
    public ?int $tax;

    /**
     * Total amount charged to the customer including tax, in smallest currency unit (e.g. cents)
     */
    #[SerializedName('total_amount')]
    public int $totalAmount;

    /**
     * Timestamp when the payment was last updated
     */
    #[SerializedName('updated_at')]
    public ?string $updatedAt;

    public function __construct(
        string $businessId,
        string $createdAt,
        Currency $currency,
        CustomerLimitedDetailsResponse $customer,
        array $disputes,
        ?string $errorMessage = null,
        array $metadata,
        string $paymentId,
        ?string $paymentLink = null,
        ?string $paymentMethod = null,
        ?string $paymentMethodType = null,
        ?array $productCart = [],
        array $refunds,
        ?IntentStatus $status = null,
        ?string $subscriptionId = null,
        ?int $tax = null,
        int $totalAmount,
        ?string $updatedAt = null
    ) {
        $this->businessId = $businessId;
        $this->createdAt = $createdAt;
        $this->currency = $currency;
        $this->customer = $customer;
        $this->disputes = $disputes;
        $this->errorMessage = $errorMessage;
        $this->metadata = $metadata;
        $this->paymentId = $paymentId;
        $this->paymentLink = $paymentLink;
        $this->paymentMethod = $paymentMethod;
        $this->paymentMethodType = $paymentMethodType;
        $this->productCart = $productCart;
        $this->refunds = $refunds;
        $this->status = $status;
        $this->subscriptionId = $subscriptionId;
        $this->tax = $tax;
        $this->totalAmount = $totalAmount;
        $this->updatedAt = $updatedAt;
    }
}
