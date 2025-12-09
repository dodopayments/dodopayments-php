<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionUpdatePaymentMethodResponseShape = array{
 *   clientSecret?: string|null,
 *   expiresOn?: \DateTimeInterface|null,
 *   paymentID?: string|null,
 *   paymentLink?: string|null,
 * }
 */
final class SubscriptionUpdatePaymentMethodResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodResponseShape> */
    use SdkModel;

    #[Optional('client_secret', nullable: true)]
    public ?string $clientSecret;

    #[Optional('expires_on', nullable: true)]
    public ?\DateTimeInterface $expiresOn;

    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    #[Optional('payment_link', nullable: true)]
    public ?string $paymentLink;

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
        ?string $paymentID = null,
        ?string $paymentLink = null,
    ): self {
        $obj = new self;

        null !== $clientSecret && $obj['clientSecret'] = $clientSecret;
        null !== $expiresOn && $obj['expiresOn'] = $expiresOn;
        null !== $paymentID && $obj['paymentID'] = $paymentID;
        null !== $paymentLink && $obj['paymentLink'] = $paymentLink;

        return $obj;
    }

    public function withClientSecret(?string $clientSecret): self
    {
        $obj = clone $this;
        $obj['clientSecret'] = $clientSecret;

        return $obj;
    }

    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $obj = clone $this;
        $obj['expiresOn'] = $expiresOn;

        return $obj;
    }

    public function withPaymentID(?string $paymentID): self
    {
        $obj = clone $this;
        $obj['paymentID'] = $paymentID;

        return $obj;
    }

    public function withPaymentLink(?string $paymentLink): self
    {
        $obj = clone $this;
        $obj['paymentLink'] = $paymentLink;

        return $obj;
    }
}
