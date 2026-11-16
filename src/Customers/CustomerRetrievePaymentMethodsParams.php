<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\CustomersService::retrievePaymentMethods()
 *
 * @phpstan-type CustomerRetrievePaymentMethodsParamsShape = array{
 *   billingCountry?: null|CountryCode|value-of<CountryCode>,
 *   currency?: null|Currency|value-of<Currency>,
 * }
 */
final class CustomerRetrievePaymentMethodsParams implements BaseModel
{
    /** @use SdkModel<CustomerRetrievePaymentMethodsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO country code alpha2 variant.
     *
     * @var value-of<CountryCode>|null $billingCountry
     */
    #[Optional(enum: CountryCode::class)]
    public ?string $billingCountry;

    /** @var value-of<Currency>|null $currency */
    #[Optional(enum: Currency::class)]
    public ?string $currency;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CountryCode|value-of<CountryCode>|null $billingCountry
     * @param Currency|value-of<Currency>|null $currency
     */
    public static function with(
        CountryCode|string|null $billingCountry = null,
        Currency|string|null $currency = null
    ): self {
        $self = new self;

        null !== $billingCountry && $self['billingCountry'] = $billingCountry;
        null !== $currency && $self['currency'] = $currency;

        return $self;
    }

    /**
     * ISO country code alpha2 variant.
     *
     * @param CountryCode|value-of<CountryCode> $billingCountry
     */
    public function withBillingCountry(CountryCode|string $billingCountry): self
    {
        $self = clone $this;
        $self['billingCountry'] = $billingCountry;

        return $self;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }
}
