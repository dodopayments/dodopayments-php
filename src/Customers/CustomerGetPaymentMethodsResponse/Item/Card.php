<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * @phpstan-type CardShape = array{
 *   cardIssuingCountry?: null|CountryCode|value-of<CountryCode>,
 *   cardNetwork?: string|null,
 *   cardType?: string|null,
 *   expiryMonth?: string|null,
 *   expiryYear?: string|null,
 *   last4Digits?: string|null,
 * }
 */
final class Card implements BaseModel
{
    /** @use SdkModel<CardShape> */
    use SdkModel;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $cardIssuingCountry
     */
    #[Optional('card_issuing_country', enum: CountryCode::class, nullable: true)]
    public ?string $cardIssuingCountry;

    #[Optional('card_network', nullable: true)]
    public ?string $cardNetwork;

    #[Optional('card_type', nullable: true)]
    public ?string $cardType;

    #[Optional('expiry_month', nullable: true)]
    public ?string $expiryMonth;

    #[Optional('expiry_year', nullable: true)]
    public ?string $expiryYear;

    #[Optional('last4_digits', nullable: true)]
    public ?string $last4Digits;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CountryCode|value-of<CountryCode>|null $cardIssuingCountry
     */
    public static function with(
        CountryCode|string|null $cardIssuingCountry = null,
        ?string $cardNetwork = null,
        ?string $cardType = null,
        ?string $expiryMonth = null,
        ?string $expiryYear = null,
        ?string $last4Digits = null,
    ): self {
        $self = new self;

        null !== $cardIssuingCountry && $self['cardIssuingCountry'] = $cardIssuingCountry;
        null !== $cardNetwork && $self['cardNetwork'] = $cardNetwork;
        null !== $cardType && $self['cardType'] = $cardType;
        null !== $expiryMonth && $self['expiryMonth'] = $expiryMonth;
        null !== $expiryYear && $self['expiryYear'] = $expiryYear;
        null !== $last4Digits && $self['last4Digits'] = $last4Digits;

        return $self;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode>|null $cardIssuingCountry
     */
    public function withCardIssuingCountry(
        CountryCode|string|null $cardIssuingCountry
    ): self {
        $self = clone $this;
        $self['cardIssuingCountry'] = $cardIssuingCountry;

        return $self;
    }

    public function withCardNetwork(?string $cardNetwork): self
    {
        $self = clone $this;
        $self['cardNetwork'] = $cardNetwork;

        return $self;
    }

    public function withCardType(?string $cardType): self
    {
        $self = clone $this;
        $self['cardType'] = $cardType;

        return $self;
    }

    public function withExpiryMonth(?string $expiryMonth): self
    {
        $self = clone $this;
        $self['expiryMonth'] = $expiryMonth;

        return $self;
    }

    public function withExpiryYear(?string $expiryYear): self
    {
        $self = clone $this;
        $self['expiryYear'] = $expiryYear;

        return $self;
    }

    public function withLast4Digits(?string $last4Digits): self
    {
        $self = clone $this;
        $self['last4Digits'] = $last4Digits;

        return $self;
    }
}
