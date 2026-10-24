<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @see Dodopayments\Services\PaymentsService::retrieveLineItems()
 *
 * @phpstan-type PaymentRetrieveLineItemsParamsShape = array{
 *   currency?: null|Currency|value-of<Currency>
 * }
 */
final class PaymentRetrieveLineItemsParams implements BaseModel
{
    /** @use SdkModel<PaymentRetrieveLineItemsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The currency of the amounts. It must be the currency that the customer paid in. Without
     * it, the amounts are in the settlement currency.
     *
     * @var value-of<Currency>|null $currency
     */
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
     * @param Currency|value-of<Currency>|null $currency
     */
    public static function with(Currency|string|null $currency = null): self
    {
        $self = new self;

        null !== $currency && $self['currency'] = $currency;

        return $self;
    }

    /**
     * The currency of the amounts. It must be the currency that the customer paid in. Without
     * it, the amounts are in the settlement currency.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }
}
