<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionUpdatePaymentMethodResponseShape = array{
 *   client_secret?: string|null,
 *   expires_on?: \DateTimeInterface|null,
 *   payment_id?: string|null,
 *   payment_link?: string|null,
 * }
 */
final class SubscriptionUpdatePaymentMethodResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodResponseShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $client_secret;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $expires_on;

    #[Optional(nullable: true)]
    public ?string $payment_id;

    #[Optional(nullable: true)]
    public ?string $payment_link;

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
        ?string $client_secret = null,
        ?\DateTimeInterface $expires_on = null,
        ?string $payment_id = null,
        ?string $payment_link = null,
    ): self {
        $obj = new self;

        null !== $client_secret && $obj['client_secret'] = $client_secret;
        null !== $expires_on && $obj['expires_on'] = $expires_on;
        null !== $payment_id && $obj['payment_id'] = $payment_id;
        null !== $payment_link && $obj['payment_link'] = $payment_link;

        return $obj;
    }

    public function withClientSecret(?string $clientSecret): self
    {
        $obj = clone $this;
        $obj['client_secret'] = $clientSecret;

        return $obj;
    }

    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $obj = clone $this;
        $obj['expires_on'] = $expiresOn;

        return $obj;
    }

    public function withPaymentID(?string $paymentID): self
    {
        $obj = clone $this;
        $obj['payment_id'] = $paymentID;

        return $obj;
    }

    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj['payment_link'] = $paymentLink;

        return $obj;
    }
}
