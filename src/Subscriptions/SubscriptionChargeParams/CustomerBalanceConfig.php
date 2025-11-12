<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions\SubscriptionChargeParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Specify how customer balance is used for the payment.
 *
 * @phpstan-type CustomerBalanceConfigShape = array{
 *   allow_customer_credits_purchase?: bool|null,
 *   allow_customer_credits_usage?: bool|null,
 * }
 */
final class CustomerBalanceConfig implements BaseModel
{
    /** @use SdkModel<CustomerBalanceConfigShape> */
    use SdkModel;

    /**
     * Allows Customer Credit to be purchased to settle payments.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $allow_customer_credits_purchase;

    /**
     * Allows Customer Credit Balance to be used to settle payments.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $allow_customer_credits_usage;

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
        ?bool $allow_customer_credits_purchase = null,
        ?bool $allow_customer_credits_usage = null,
    ): self {
        $obj = new self;

        null !== $allow_customer_credits_purchase && $obj->allow_customer_credits_purchase = $allow_customer_credits_purchase;
        null !== $allow_customer_credits_usage && $obj->allow_customer_credits_usage = $allow_customer_credits_usage;

        return $obj;
    }

    /**
     * Allows Customer Credit to be purchased to settle payments.
     */
    public function withAllowCustomerCreditsPurchase(
        ?bool $allowCustomerCreditsPurchase
    ): self {
        $obj = clone $this;
        $obj->allow_customer_credits_purchase = $allowCustomerCreditsPurchase;

        return $obj;
    }

    /**
     * Allows Customer Credit Balance to be used to settle payments.
     */
    public function withAllowCustomerCreditsUsage(
        ?bool $allowCustomerCreditsUsage
    ): self {
        $obj = clone $this;
        $obj->allow_customer_credits_usage = $allowCustomerCreditsUsage;

        return $obj;
    }
}
