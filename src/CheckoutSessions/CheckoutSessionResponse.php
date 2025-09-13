<?php

declare(strict_types=1);

namespace Dodopayments\CheckoutSessions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type checkout_session_response = array{
 *   checkoutURL: string, sessionID: string
 * }
 * When used in a response, this type parameter can define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class CheckoutSessionResponse implements BaseModel
{
    /** @use SdkModel<checkout_session_response> */
    use SdkModel;

    /**
     * Checkout url.
     */
    #[Api('checkout_url')]
    public string $checkoutURL;

    /**
     * The ID of the created checkout session.
     */
    #[Api('session_id')]
    public string $sessionID;

    /**
     * `new CheckoutSessionResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckoutSessionResponse::with(checkoutURL: ..., sessionID: ...)
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
    public static function with(string $checkoutURL, string $sessionID): self
    {
        $obj = new self;

        $obj->checkoutURL = $checkoutURL;
        $obj->sessionID = $sessionID;

        return $obj;
    }

    /**
     * Checkout url.
     */
    public function withCheckoutURL(string $checkoutURL): self
    {
        $obj = clone $this;
        $obj->checkoutURL = $checkoutURL;

        return $obj;
    }

    /**
     * The ID of the created checkout session.
     */
    public function withSessionID(string $sessionID): self
    {
        $obj = clone $this;
        $obj->sessionID = $sessionID;

        return $obj;
    }
}
