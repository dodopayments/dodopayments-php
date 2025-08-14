<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type customer_limited_details_alias = array{
 *   customerID: string, email: string, name: string
 * }
 */
final class CustomerLimitedDetails implements BaseModel
{
    use Model;

    /**
     * Unique identifier for the customer.
     */
    #[Api('customer_id')]
    public string $customerID;

    /**
     * Email address of the customer.
     */
    #[Api]
    public string $email;

    /**
     * Full name of the customer.
     */
    #[Api]
    public string $name;

    /**
     * `new CustomerLimitedDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerLimitedDetails::with(customerID: ..., email: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerLimitedDetails)->withCustomerID(...)->withEmail(...)->withName(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $customerID,
        string $email,
        string $name
    ): self {
        $obj = new self;

        $obj->customerID = $customerID;
        $obj->email = $email;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Unique identifier for the customer.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * Email address of the customer.
     */
    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    /**
     * Full name of the customer.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
