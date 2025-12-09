<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChargeParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Specify how customer balance is used for the payment.
 *
 * @phpstan-type CustomerBalanceConfigShape = array{
 *   allowCustomerCreditsPurchase?: bool|null,
 *   allowCustomerCreditsUsage?: bool|null,
 * }
 */
final class CustomerBalanceConfig implements BaseModel
{
    /** @use SdkModel<CustomerBalanceConfigShape> */
    use SdkModel;

    /**
     * Allows Customer Credit to be purchased to settle payments.
     */
    #[Optional('allow_customer_credits_purchase', nullable: true)]
    public ?bool $allowCustomerCreditsPurchase;

    /**
     * Allows Customer Credit Balance to be used to settle payments.
     */
    #[Optional('allow_customer_credits_usage', nullable: true)]
    public ?bool $allowCustomerCreditsUsage;

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
        ?bool $allowCustomerCreditsPurchase = null,
        ?bool $allowCustomerCreditsUsage = null,
    ): self {
        $obj = new self;

        null !== $allowCustomerCreditsPurchase && $obj['allowCustomerCreditsPurchase'] = $allowCustomerCreditsPurchase;
        null !== $allowCustomerCreditsUsage && $obj['allowCustomerCreditsUsage'] = $allowCustomerCreditsUsage;

        return $obj;
    }

    /**
     * Allows Customer Credit to be purchased to settle payments.
     */
    public function withAllowCustomerCreditsPurchase(
        ?bool $allowCustomerCreditsPurchase
    ): self {
        $obj = clone $this;
        $obj['allowCustomerCreditsPurchase'] = $allowCustomerCreditsPurchase;

        return $obj;
    }

    /**
     * Allows Customer Credit Balance to be used to settle payments.
     */
    public function withAllowCustomerCreditsUsage(
        ?bool $allowCustomerCreditsUsage
    ): self {
        $obj = clone $this;
        $obj['allowCustomerCreditsUsage'] = $allowCustomerCreditsUsage;

        return $obj;
    }
}
