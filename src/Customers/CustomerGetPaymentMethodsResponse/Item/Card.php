<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * @phpstan-type CardShape = array{
 *   cardIssuingCountry?: value-of<CountryCode>|null,
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
        $obj = new self;

        null !== $cardIssuingCountry && $obj['cardIssuingCountry'] = $cardIssuingCountry;
        null !== $cardNetwork && $obj['cardNetwork'] = $cardNetwork;
        null !== $cardType && $obj['cardType'] = $cardType;
        null !== $expiryMonth && $obj['expiryMonth'] = $expiryMonth;
        null !== $expiryYear && $obj['expiryYear'] = $expiryYear;
        null !== $last4Digits && $obj['last4Digits'] = $last4Digits;

        return $obj;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode>|null $cardIssuingCountry
     */
    public function withCardIssuingCountry(
        CountryCode|string|null $cardIssuingCountry
    ): self {
        $obj = clone $this;
        $obj['cardIssuingCountry'] = $cardIssuingCountry;

        return $obj;
    }

    public function withCardNetwork(?string $cardNetwork): self
    {
        $obj = clone $this;
        $obj['cardNetwork'] = $cardNetwork;

        return $obj;
    }

    public function withCardType(?string $cardType): self
    {
        $obj = clone $this;
        $obj['cardType'] = $cardType;

        return $obj;
    }

    public function withExpiryMonth(?string $expiryMonth): self
    {
        $obj = clone $this;
        $obj['expiryMonth'] = $expiryMonth;

        return $obj;
    }

    public function withExpiryYear(?string $expiryYear): self
    {
        $obj = clone $this;
        $obj['expiryYear'] = $expiryYear;

        return $obj;
    }

    public function withLast4Digits(?string $last4Digits): self
    {
        $obj = clone $this;
        $obj['last4Digits'] = $last4Digits;

        return $obj;
    }
}
