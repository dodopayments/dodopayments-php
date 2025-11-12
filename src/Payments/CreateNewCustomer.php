<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreateNewCustomerShape = array{
 *   email: string,
 *   name: string,
 *   create_new_customer?: bool|null,
 *   phone_number?: string|null,
 * }
 */
final class CreateNewCustomer implements BaseModel
{
    /** @use SdkModel<CreateNewCustomerShape> */
    use SdkModel;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    #[Api(optional: true)]
    public ?bool $create_new_customer;

    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

    /**
     * `new CreateNewCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreateNewCustomer::with(email: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreateNewCustomer)->withEmail(...)->withName(...)
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
        string $email,
        string $name,
        ?bool $create_new_customer = null,
        ?string $phone_number = null,
    ): self {
        $obj = new self;

        $obj->email = $email;
        $obj->name = $name;

        null !== $create_new_customer && $obj->create_new_customer = $create_new_customer;
        null !== $phone_number && $obj->phone_number = $phone_number;

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

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    public function withCreateNewCustomer(bool $createNewCustomer): self
    {
        $obj = clone $this;
        $obj->create_new_customer = $createNewCustomer;

        return $obj;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phone_number = $phoneNumber;

        return $obj;
    }
}
