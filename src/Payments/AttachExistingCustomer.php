<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type attach_existing_customer_alias = array{customerID: string}
 */
final class AttachExistingCustomer implements BaseModel
{
    use SdkModel;

    #[Api('customer_id')]
    public string $customerID;

    /**
     * `new AttachExistingCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachExistingCustomer::with(customerID: ...)
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $customerID): self
    {
        $obj = new self;

        $obj->customerID = $customerID;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }
}
