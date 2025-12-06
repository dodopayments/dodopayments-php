<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerGetPaymentMethodsResponse\Item;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;

/**
 * @phpstan-type CardShape = array{
 *   card_issuing_country?: value-of<CountryCode>|null,
 *   card_network?: string|null,
 *   card_type?: string|null,
 *   expiry_month?: string|null,
 *   expiry_year?: string|null,
 *   last4_digits?: string|null,
 * }
 */
final class Card implements BaseModel
{
    /** @use SdkModel<CardShape> */
    use SdkModel;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $card_issuing_country
     */
    #[Api(enum: CountryCode::class, nullable: true, optional: true)]
    public ?string $card_issuing_country;

    #[Api(nullable: true, optional: true)]
    public ?string $card_network;

    #[Api(nullable: true, optional: true)]
    public ?string $card_type;

    #[Api(nullable: true, optional: true)]
    public ?string $expiry_month;

    #[Api(nullable: true, optional: true)]
    public ?string $expiry_year;

    #[Api(nullable: true, optional: true)]
    public ?string $last4_digits;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CountryCode|value-of<CountryCode>|null $card_issuing_country
     */
    public static function with(
        CountryCode|string|null $card_issuing_country = null,
        ?string $card_network = null,
        ?string $card_type = null,
        ?string $expiry_month = null,
        ?string $expiry_year = null,
        ?string $last4_digits = null,
    ): self {
        $obj = new self;

        null !== $card_issuing_country && $obj['card_issuing_country'] = $card_issuing_country;
        null !== $card_network && $obj['card_network'] = $card_network;
        null !== $card_type && $obj['card_type'] = $card_type;
        null !== $expiry_month && $obj['expiry_month'] = $expiry_month;
        null !== $expiry_year && $obj['expiry_year'] = $expiry_year;
        null !== $last4_digits && $obj['last4_digits'] = $last4_digits;

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
        $obj['card_issuing_country'] = $cardIssuingCountry;

        return $obj;
    }

    public function withCardNetwork(?string $cardNetwork): self
    {
        $obj = clone $this;
        $obj['card_network'] = $cardNetwork;

        return $obj;
    }

    public function withCardType(?string $cardType): self
    {
        $obj = clone $this;
        $obj['card_type'] = $cardType;

        return $obj;
    }

    public function withExpiryMonth(?string $expiryMonth): self
    {
        $obj = clone $this;
        $obj['expiry_month'] = $expiryMonth;

        return $obj;
    }

    public function withExpiryYear(?string $expiryYear): self
    {
        $obj = clone $this;
        $obj['expiry_year'] = $expiryYear;

        return $obj;
    }

    public function withLast4Digits(?string $last4Digits): self
    {
        $obj = clone $this;
        $obj['last4_digits'] = $last4Digits;

        return $obj;
    }
}
