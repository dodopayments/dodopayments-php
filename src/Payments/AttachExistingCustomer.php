<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachExistingCustomerShape = array{customer_id: string}
 */
final class AttachExistingCustomer implements BaseModel
{
    /** @use SdkModel<AttachExistingCustomerShape> */
    use SdkModel;

    #[Api]
    public string $customer_id;

    /**
     * `new AttachExistingCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachExistingCustomer::with(customer_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachExistingCustomer)->withCustomerID(...)
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
     */
    public static function with(string $customer_id): self
    {
        $obj = new self;

        $obj->customer_id = $customer_id;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customer_id = $customerID;

        return $obj;
    }
}
