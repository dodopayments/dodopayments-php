<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewCustomerShape = array{
 *   email: string, name?: string|null, phoneNumber?: string|null
 * }
 */
final class NewCustomer implements BaseModel
{
    /** @use SdkModel<NewCustomerShape> */
    use SdkModel;

    /**
     * Email is required for creating a new customer.
     */
    #[Required]
    public string $email;

    /**
     * Optional full name of the customer. If provided during session creation,
     * it is persisted and becomes immutable for the session. If omitted here,
     * it can be provided later via the confirm API.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    /**
     * `new NewCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewCustomer::with(email: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewCustomer)->withEmail(...)
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
        ?string $name = null,
        ?string $phoneNumber = null
    ): self {
        $self = new self;

        $self['email'] = $email;

        null !== $name && $self['name'] = $name;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * Email is required for creating a new customer.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Optional full name of the customer. If provided during session creation,
     * it is persisted and becomes immutable for the session. If omitted here,
     * it can be provided later via the confirm API.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }
}
