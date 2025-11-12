<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type CustomerShape = array{
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   customer_id: string,
 *   email: string,
 *   name: string,
 *   phone_number?: string|null,
 * }
 */
final class Customer implements BaseModel, ResponseConverter
{
    /** @use SdkModel<CustomerShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $business_id;

    #[Api]
    public \DateTimeInterface $created_at;

    #[Api]
    public string $customer_id;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

    /**
     * `new Customer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Customer::with(
     *   business_id: ..., created_at: ..., customer_id: ..., email: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Customer)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerID(...)
     *   ->withEmail(...)
     *   ->withName(...)
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
    public static function with(
        string $business_id,
        \DateTimeInterface $created_at,
        string $customer_id,
        string $email,
        string $name,
        ?string $phone_number = null,
    ): self {
        $obj = new self;

        $obj->business_id = $business_id;
        $obj->created_at = $created_at;
        $obj->customer_id = $customer_id;
        $obj->email = $email;
        $obj->name = $name;

        null !== $phone_number && $obj->phone_number = $phone_number;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->business_id = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->created_at = $createdAt;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customer_id = $customerID;

        return $obj;
    }

    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phone_number = $phoneNumber;

        return $obj;
    }
}
