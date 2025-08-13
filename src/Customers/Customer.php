<?php

declare(strict_types=1);

namespace DodoPayments\Customers;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type customer_alias = array{
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   email: string,
 *   name: string,
 *   phoneNumber?: string|null,
 * }
 */
final class Customer implements BaseModel
{
    use Model;

    #[Api('business_id')]
    public string $businessID;

    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    #[Api('customer_id')]
    public string $customerID;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    #[Api('phone_number', optional: true)]
    public ?string $phoneNumber;

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
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        string $email,
        string $name,
        ?string $phoneNumber = null,
    ): self {
        $obj = new self;

        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->customerID = $customerID;
        $obj->email = $email;
        $obj->name = $name;

        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;

        return $obj;
    }

    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
