<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::deletePaymentMethod()
 *
 * @phpstan-type CustomerDeletePaymentMethodParamsShape = array{customerID: string}
 */
final class CustomerDeletePaymentMethodParams implements BaseModel
{
    /** @use SdkModel<CustomerDeletePaymentMethodParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $customerID;

    /**
     * `new CustomerDeletePaymentMethodParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerDeletePaymentMethodParams::with(customerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerDeletePaymentMethodParams)->withCustomerID(...)
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
