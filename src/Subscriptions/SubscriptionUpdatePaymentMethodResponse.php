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
        $self = new self;

        null !== $clientSecret && $self['clientSecret'] = $clientSecret;
        null !== $expiresOn && $self['expiresOn'] = $expiresOn;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $paymentLink && $self['paymentLink'] = $paymentLink;

        return $self;
    }

    public function withClientSecret(?string $clientSecret): self
    {
        $self = clone $this;
        $self['clientSecret'] = $clientSecret;

        return $self;
    }

    public function withExpiresOn(?\DateTimeInterface $expiresOn): self
    {
        $self = clone $this;
        $self['expiresOn'] = $expiresOn;

        return $self;
    }

    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withPaymentLink(?string $paymentLink): self
    {
        $self = clone $this;
        $self['paymentLink'] = $paymentLink;

        return $self;
    }
}
