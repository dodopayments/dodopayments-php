<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomerLimitedDetailsShape = array{
 *   customerID: string,
 *   email: string,
 *   name: string,
 *   metadata?: array<string,string>|null,
 *   phoneNumber?: string|null,
 * }
 */
final class CustomerLimitedDetails implements BaseModel
{
    /** @use SdkModel<CustomerLimitedDetailsShape> */
    use SdkModel;

    /**
     * Unique identifier for the customer.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * Email address of the customer.
     */
    #[Required]
    public string $email;

    /**
     * Full name of the customer.
     */
    #[Required]
    public string $name;

    /**
     * Additional metadata associated with the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Phone number of the customer.
     */
    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    /**
     * `new CustomerLimitedDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerLimitedDetails::with(customerID: ..., email: ..., name: ...)
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
        string $customerID,
        string $email,
        string $name,
        ?array $metadata = null,
        ?string $phoneNumber = null,
    ): self {
        $self = new self;

        $self['customerID'] = $customerID;
        $self['email'] = $email;
        $self['name'] = $name;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * Unique identifier for the customer.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Email address of the customer.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Full name of the customer.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Additional metadata associated with the customer.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Phone number of the customer.
     */
    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }
}
