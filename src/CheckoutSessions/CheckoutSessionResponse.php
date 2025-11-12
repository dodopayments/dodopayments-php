<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type CheckoutSessionResponseShape = array{
 *   checkout_url: string, session_id: string
 * }
 */
final class CheckoutSessionResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<CheckoutSessionResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Checkout url.
     */
    #[Api]
    public string $checkout_url;

    /**
     * The ID of the created checkout session.
     */
    #[Api]
    public string $session_id;

    /**
     * `new CheckoutSessionResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionResponse::with(checkout_url: ..., session_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckoutSessionResponse)->withCheckoutURL(...)->withSessionID(...)
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
    public static function with(string $checkout_url, string $session_id): self
    {
        $obj = new self;

        $obj->checkout_url = $checkout_url;
        $obj->session_id = $session_id;

        return $obj;
    }

    /**
     * Checkout url.
     */
    public function withCheckoutURL(string $checkoutURL): self
    {
        $obj = clone $this;
        $obj->checkout_url = $checkoutURL;

        return $obj;
    }

    /**
     * The ID of the created checkout session.
     */
    public function withSessionID(string $sessionID): self
    {
        $obj = clone $this;
        $obj->session_id = $sessionID;

        return $obj;
    }
}
