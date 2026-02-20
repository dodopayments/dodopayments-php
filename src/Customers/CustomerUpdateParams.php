<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::update()
 *
 * @phpstan-type CustomerUpdateParamsShape = array{
 *   email?: string|null,
 *   metadata?: array<string,string>|null,
 *   name?: string|null,
 *   phoneNumber?: string|null,
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    /** @use SdkModel<CustomerUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $email;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?string $email = null,
        ?array $metadata = null,
        ?string $name = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $name && $self['name'] = $name;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Additional metadata for the customer.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

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
