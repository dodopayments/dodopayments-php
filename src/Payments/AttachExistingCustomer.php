<?php

declare(strict_types=1);

namespace DodoPayments\Payments;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type attach_existing_customer_alias = array{customerID: string}
 */
final class AttachExistingCustomer implements BaseModel
{
    use Model;

    #[Api('customer_id')]
    public string $customerID;

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
    public static function from(string $customerID): self
    {
        $obj = new self;

        $obj->customerID = $customerID;

        return $obj;
    }

    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }
}
