<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Handles for a hosted checkout page that settles a plan change.
 *
 * The four fields repeat `UpdatePaymentMethodResponse` and a subset of
 * `CreateSubscriptionResponse`. A shared type would rename the generated SDK
 * types for all three routes, so each route keeps its own.
 *
 * @phpstan-type SubscriptionChangePlanResponseShape = array{
 *   clientSecret?: string|null,
 *   expiresOn?: \DateTimeInterface|null,
 *   invoiceID?: string|null,
 *   paymentID?: string|null,
 *   paymentLink?: string|null,
 *   refundID?: string|null,
 * }
 */
final class SubscriptionChangePlanResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionChangePlanResponseShape> */
    use SdkModel;

    /**
     * Client secret for an embedded checkout.
     */
    #[Optional('client_secret', nullable: true)]
    public ?string $clientSecret;

    /**
     * When the link stops working.
     */
    #[Optional('expires_on', nullable: true)]
    public ?\DateTimeInterface $expiresOn;

    /**
     * The invoice that bills the plan change. Set only for an invoice-led subscription.
     */
    #[Optional('invoice_id', nullable: true)]
    public ?string $invoiceID;

    /**
     * Id of the payment that settles the plan change.
     */
    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    /**
     * Checkout page URL. Give this to the customer.
     */
    #[Optional('payment_link', nullable: true)]
    public ?string $paymentLink;

    /**
     * The refund of a downgrade with `credit: refund`.
     */
    #[Optional('refund_id', nullable: true)]
    public ?string $refundID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $clientSecret = null,
        ?\DateTimeInterface $expiresOn = null,
        ?string $invoiceID = null,
        ?string $paymentID = null,
        ?string $paymentLink = null,
        ?string $refundID = null,
    ): self {
        $self = new self;

        null !== $clientSecret && $self['clientSecret'] = $clientSecret;
        null !== $expiresOn && $self['expiresOn'] = $expiresOn;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;
        null !== $refundID && $self['refundID'] = $refundID;

        return $self;
    }

    /**
     * Client secret for an embedded checkout.
     */
    public function withClientSecret(?string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    /**
     * When the link stops working.
     */
    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $self = clone $this;
        $self['expiresOn'] = $expiresOn;

        return $self;
    }

    /**
     * The invoice that bills the plan change. Set only for an invoice-led subscription.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * Id of the payment that settles the plan change.
     */
    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Checkout page URL. Give this to the customer.
     */
    public function withPaymentLink(?string $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }

    /**
     * The refund of a downgrade with `credit: refund`.
     */
    public function withRefundID(?string $refundID): self
    {
        $self = clone $this;
        $self['refundID'] = $refundID;

        return $self;
    }
}
