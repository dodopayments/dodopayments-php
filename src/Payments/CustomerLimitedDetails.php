<?php

declare(strict_types=1);

namespace DodopaymentsClient\Payments;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;

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
    public static function from(
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
    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * Email address of the customer.
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Full name of the customer.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
