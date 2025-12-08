<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse\ImmediateCharge;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Misc\Currency;

/**
 * @phpstan-type SummaryShape = array{
 *   currency: value-of<Currency>,
 *   customer_credits: int,
 *   settlement_amount: int,
 *   settlement_currency: value-of<Currency>,
 *   total_amount: int,
 *   settlement_tax?: int|null,
 *   tax?: int|null,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
    use SdkModel;

    /** @var value-of<Currency> $currency */
    #[Api(enum: Currency::class)]
    public string $currency;

    #[Api]
    public int $customer_credits;

    #[Api]
    public int $settlement_amount;

    /** @var value-of<Currency> $settlement_currency */
    #[Api(enum: Currency::class)]
    public string $settlement_currency;

    #[Api]
    public int $total_amount;

    #[Api(nullable: true, optional: true)]
    public ?int $settlement_tax;

    #[Api(nullable: true, optional: true)]
    public ?int $tax;

    /**
     * `new Summary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Summary::with(
     *   currency: ...,
     *   customer_credits: ...,
     *   settlement_amount: ...,
     *   settlement_currency: ...,
     *   total_amount: ...,
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
     * @param Currency|value-of<Currency> $settlement_currency
     */
    public static function with(
        Currency|string $currency,
        int $customer_credits,
        int $settlement_amount,
        Currency|string $settlement_currency,
        int $total_amount,
        ?int $settlement_tax = null,
        ?int $tax = null,
    ): self {
        $obj = new self;

        $obj['currency'] = $currency;
        $obj['customer_credits'] = $customer_credits;
        $obj['settlement_amount'] = $settlement_amount;
        $obj['settlement_currency'] = $settlement_currency;
        $obj['total_amount'] = $total_amount;

        null !== $settlement_tax && $obj['settlement_tax'] = $settlement_tax;
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
        $obj['customer_credits'] = $customerCredits;

        return $obj;
    }

    public function withSettlementAmount(int $settlementAmount): self
    {
        $obj = clone $this;
        $obj['settlement_amount'] = $settlementAmount;

        return $obj;
    }

    /**
     * @param Currency|value-of<Currency> $settlementCurrency
     */
    public function withSettlementCurrency(
        Currency|string $settlementCurrency
    ): self {
        $obj = clone $this;
        $obj['settlement_currency'] = $settlementCurrency;

        return $obj;
    }

    public function withTotalAmount(int $totalAmount): self
    {
        $obj = clone $this;
        $obj['total_amount'] = $totalAmount;

        return $obj;
    }

    public function withSettlementTax(?int $settlementTax): self
    {
        $obj = clone $this;
        $obj['settlement_tax'] = $settlementTax;

        return $obj;
    }

    public function withTax(?int $tax): self
    {
        $obj = clone $this;
        $obj['tax'] = $tax;

        return $obj;
    }
}
