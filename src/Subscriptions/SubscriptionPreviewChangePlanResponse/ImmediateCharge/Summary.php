<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type SummaryShape = array{
 *   currency: value-of<Currency>,
 *   customerCredits: int,
 *   settlementAmount: int,
 *   settlementCurrency: value-of<Currency>,
 *   totalAmount: int,
 *   settlementTax?: int|null,
 *   tax?: int|null,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /** @var value-of<Currency> $currency */
    #[Required(enum: Currency::class)]
    public string $currency;

    #[Required('customer_credits')]
    public int $customerCredits;

    #[Required('settlement_amount')]
    public int $settlementAmount;

    /** @var value-of<Currency> $settlementCurrency */
    #[Required('settlement_currency', enum: Currency::class)]
    public string $settlementCurrency;

    #[Required('total_amount')]
    public int $totalAmount;

    #[Optional('settlement_tax', nullable: true)]
    public ?int $settlementTax;

    #[Optional(nullable: true)]
    public ?int $tax;

    /**
     * `new Summary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Summary::with(
     *   currency: ...,
     *   customerCredits: ...,
     *   settlementAmount: ...,
     *   settlementCurrency: ...,
     *   totalAmount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Summary)
     *   ->withCurrency(...)
     *   ->withCustomerCredits(...)
     *   ->withSettlementAmount(...)
     *   ->withSettlementCurrency(...)
     *   ->withTotalAmount(...)
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
     *
     * @param Currency|value-of<Currency> $currency
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public static function with(
        Currency|string $currency,
        int $customerCredits,
        int $settlementAmount,
        Currency|string $settlementCurrency,
        int $totalAmount,
        ?int $settlementTax = null,
        ?int $tax = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['customerCredits'] = $customerCredits;
        $obj['settlementAmount'] = $settlementAmount;
        $obj['settlementCurrency'] = $settlementCurrency;
        $obj['totalAmount'] = $totalAmount;

        null !== $settlementTax && $obj['settlementTax'] = $settlementTax;
        null !== $tax && $obj['tax'] = $tax;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    public function withCustomerCredits(int $customerCredits): self
    {
        $obj = clone $this;
        $obj['customerCredits'] = $customerCredits;

        return $obj;
    }

    public function withSettlementAmount(int $settlementAmount): self
    {
        $obj = clone $this;
        $obj['settlementAmount'] = $settlementAmount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public function withSettlementCurrency(
        Currency|string $settlementCurrency
    ): self {
        $obj = clone $this;
        $obj['settlementCurrency'] = $settlementCurrency;

        return $obj;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['totalAmount'] = $totalAmount;

        return $obj;
    }

    public function withSettlementTax(?int $settlementTax): self
    {
        $obj = clone $this;
        $obj['settlementTax'] = $settlementTax;

        return $obj;
    }

    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }
}
