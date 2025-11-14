<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomerLimitedDetailsShape = array{
 *   customer_id: string,
 *   email: string,
 *   name: string,
 *   metadata?: array<string,string>|null,
 *   phone_number?: string|null,
 * }
 */
final class CustomerLimitedDetails implements BaseModel
{
    /** @use SdkModel<CustomerLimitedDetailsShape> */
    use SdkModel;

    /**
     * Unique identifier for the customer.
     */
    #[Api]
    public string $customer_id;

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
     * Additional metadata associated with the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    /**
     * Phone number of the customer.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

    /**
     * `new CustomerLimitedDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerLimitedDetails::with(customer_id: ..., email: ..., name: ...)
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string> $metadata
     */
    public static function with(
        string $customer_id,
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phone_number = null,
    ): self {
        $obj = new self;

        $obj->customer_id = $customer_id;
        $obj->email = $email;
        $obj->name = $name;

        null !== $metadata && $obj->metadata = $metadata;
        null !== $phone_number && $obj->phone_number = $phone_number;

        return $obj;
    }

    /**
     * Unique identifier for the customer.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customer_id = $customerID;

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

    /**
     * Additional metadata associated with the customer.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Phone number of the customer.
     */
    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phone_number = $phoneNumber;

        return $obj;
    }
}
