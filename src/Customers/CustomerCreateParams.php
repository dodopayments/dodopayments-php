<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
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
 *   phone_number?: string|null,
 * }
 */
final class CustomerCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', optional: true)]
    public ?array $metadata;

    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

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
        ?string $phone_number = null,
    ): self {
        $obj = new self;

        $obj['email'] = $email;
        $obj['name'] = $name;

        null !== $metadata && $obj['metadata'] = $metadata;
        null !== $phone_number && $obj['phone_number'] = $phone_number;

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
        $obj['phone_number'] = $phoneNumber;

        return $obj;
    }
}
