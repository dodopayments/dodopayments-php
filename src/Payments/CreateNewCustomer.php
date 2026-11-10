<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreateNewCustomerShape = array{
 *   email: string,
 *   name: string,
 *   createNewCustomer?: bool|null,
 *   phoneNumber?: string|null,
 * }
 */
final class CreateNewCustomer implements BaseModel
{
    /** @use SdkModel<CreateNewCustomerShape> */
    use SdkModel;

    #[Required]
    public string $email;

    #[Required]
    public string $name;

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    #[Optional('create_new_customer')]
    public ?bool $createNewCustomer;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

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
        ?bool $createNewCustomer = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        $self['email'] = $email;
        $self['name'] = $name;

        null !== $createNewCustomer && $self['createNewCustomer'] = $createNewCustomer;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * When false, the most recently created customer object with the given email is used if exists.
     * When true, a new customer object is always created
     * False by default.
     */
    public function withCreateNewCustomer(bool $createNewCustomer): self
    {
        $self = clone $this;
        $self['createNewCustomer'] = $createNewCustomer;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }
}
