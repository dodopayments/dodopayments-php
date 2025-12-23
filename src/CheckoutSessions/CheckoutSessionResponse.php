<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CheckoutSessionResponseShape = array{
 *   sessionID: string, checkoutURL?: string|null
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
        ?string $checkoutURL = null
    ): self {
        $self = new self;

        $self['sessionID'] = $sessionID;

        null !== $checkoutURL && $self['checkoutURL'] = $checkoutURL;

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
}
