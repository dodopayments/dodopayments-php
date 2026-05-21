<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CheckoutSessionResponseShape = array{
 *   sessionID: string,
 *   checkoutURL?: string|null,
 *   clientSecret?: string|null,
 *   paymentID?: string|null,
 *   publishableKey?: string|null,
 * }
 */
final class CheckoutSessionResponse implements BaseModel
{
    /** @use SdkModel<CheckoutSessionResponseShape> */
    use SdkModel;

    /**
     * The ID of the created checkout session.
     */
    #[Required('session_id')]
    public string $sessionID;

    /**
     * Checkout url (None when payment_method_id is provided).
     */
    #[Optional('checkout_url', nullable: true)]
    public ?string $checkoutURL;

    /**
     * Client secret used to load the Dodo Payments checkout SDK. Returned when
     * `confirm: true` was passed and a PaymentIntent was created at
     * session-creation time. `None` otherwise.
     */
    #[Optional('client_secret', nullable: true)]
    public ?string $clientSecret;

    /**
     * Underlying payment id when `confirm: true` was passed and a PaymentIntent
     * was created at session-creation time. `None` otherwise.
     */
    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    /**
     * Publishable key for the Dodo Payments checkout SDK. Returned when
     * `confirm: true` was passed and a PaymentIntent was created at
     * session-creation time. `None` otherwise.
     */
    #[Optional('publishable_key', nullable: true)]
    public ?string $publishableKey;

    /**
     * `new CheckoutSessionResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionResponse::with(sessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionResponse)->withSessionID(...)
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
     */
    public static function with(
        string $sessionID,
        ?string $checkoutURL = null,
        ?string $clientSecret = null,
        ?string $paymentID = null,
        ?string $publishableKey = null,
    ): self {
        $self = new self;

        $self['sessionID'] = $sessionID;

        null !== $checkoutURL && $self['checkoutURL'] = $checkoutURL;
        null !== $clientSecret && $self['clientSecret'] = $clientSecret;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $publishableKey && $self['publishableKey'] = $publishableKey;

        return $self;
    }

    /**
     * The ID of the created checkout session.
     */
    public function withSessionID(string $sessionID): self
    {
        $self = clone $this;
        $self['sessionID'] = $sessionID;

        return $self;
    }

    /**
     * Checkout url (None when payment_method_id is provided).
     */
    public function withCheckoutURL(?string $checkoutURL): self
    {
        $self = clone $this;
        $self['checkoutURL'] = $checkoutURL;

        return $self;
    }

    /**
     * Client secret used to load the Dodo Payments checkout SDK. Returned when
     * `confirm: true` was passed and a PaymentIntent was created at
     * session-creation time. `None` otherwise.
     */
    public function withClientSecret(?string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    /**
     * Underlying payment id when `confirm: true` was passed and a PaymentIntent
     * was created at session-creation time. `None` otherwise.
     */
    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Publishable key for the Dodo Payments checkout SDK. Returned when
     * `confirm: true` was passed and a PaymentIntent was created at
     * session-creation time. `None` otherwise.
     */
    public function withPublishableKey(?string $publishableKey): self
    {
        $self = clone $this;
        $self['publishableKey'] = $publishableKey;

        return $self;
    }
}
