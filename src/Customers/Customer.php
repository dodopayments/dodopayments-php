<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomerShape = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   email: string,
 *   name: string,
 *   metadata?: array<string,string>|null,
 *   phoneNumber?: string|null,
 * }
 */
final class Customer implements BaseModel
{
    /** @use SdkModel<CustomerShape> */
    use SdkModel;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('customer_id')]
    public string $customerID;

    #[Required]
    public string $email;

    #[Required]
    public string $name;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    /**
     * `new Customer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Customer::with(
     *   businessID: ..., createdAt: ..., customerID: ..., email: ..., name: ...
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
     *
     * @param array<string,string> $metadata
     */
    public static function with(
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
    ): self {
        $obj = new self;

        $obj['businessID'] = $businessID;
        $obj['createdAt'] = $createdAt;
        $obj['customerID'] = $customerID;
        $obj['email'] = $email;
        $obj['name'] = $name;

        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $phoneNumber && $obj['phoneNumber'] = $phoneNumber;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['businessID'] = $businessID;

        return $obj;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj['customerID'] = $customerID;

        return $obj;
    }

    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj['email'] = $email;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Additional metadata for the customer.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $obj = clone $this;
        $obj['metadata'] = $metadata;

        return $obj;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj['phoneNumber'] = $phoneNumber;

        return $obj;
    }
}
