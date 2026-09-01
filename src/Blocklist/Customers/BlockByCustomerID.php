<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlockByCustomerIDShape = array{customerID: string}
 */
final class BlockByCustomerID implements BaseModel
{
    /** @use SdkModel<BlockByCustomerIDShape> */
    use SdkModel;

    /**
     * Customer to block. The block still applies to that customer's email.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * `new BlockByCustomerID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BlockByCustomerID::with(customerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BlockByCustomerID)->withCustomerID(...)
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

    /**
     * Customer to block. The block still applies to that customer's email.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }
}
