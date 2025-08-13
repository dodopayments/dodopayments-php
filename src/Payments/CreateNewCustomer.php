<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type create_new_customer_alias = array{
 *   email: string,
 *   name: string,
 *   createNewCustomer?: bool,
 *   phoneNumber?: string|null,
 * }
 */
final class CreateNewCustomer implements BaseModel
{
    use Model;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    #[Api('create_new_customer', optional: true)]
    public ?bool $createNewCustomer;

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
        string $email,
        string $name,
        ?bool $createNewCustomer = null,
        ?string $phoneNumber = null,
    ): self {
        $obj = new self;

        $obj->email = $email;
        $obj->name = $name;

        null !== $createNewCustomer && $obj->createNewCustomer = $createNewCustomer;
        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;

        return $obj;
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

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    public function setCreateNewCustomer(bool $createNewCustomer): self
    {
        $this->createNewCustomer = $createNewCustomer;

        return $this;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
