<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type AttachExistingCustomerShape = array{customerID: string}
 */
final class AttachExistingCustomer implements BaseModel
{
    /** @use SdkModel<AttachExistingCustomerShape> */
    use SdkModel;

    #[Required('customer_id')]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $customerID): self
    {
        $self = new self;

        $self['customerID'] = $customerID;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }
}
