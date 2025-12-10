<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::create()
 *
 * @phpstan-type CustomerCreateParamsShape = array{
 *   email: string,
 *   name: string,
 *   metadata?: array<string,string>,
 *   phoneNumber?: string|null,
 * }
 */
final class CustomerCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * `new CustomerCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerCreateParams::with(email: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerCreateParams)->withEmail(...)->withName(...)
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
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        $self['email'] = $email;
        $self['name'] = $name;

        null !== $metadata && $self['metadata'] = $metadata;
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
     * Additional metadata for the customer.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }
}
