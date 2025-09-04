<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new CustomerCreateParams); // set properties as needed
 * $client->customers->create(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->customers->create(...$params->toArray());`
 *
 * @see Dodopayments\Customers->create
 *
 * @phpstan-type customer_create_params = array{
 *   email: string, name: string, phoneNumber?: string|null
 * }
 */
final class CustomerCreateParams implements BaseModel
{
    /** @use SdkModel<customer_create_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    #[Api('phone_number', nullable: true, optional: true)]
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
     */
    public static function with(
        string $email,
        string $name,
        ?string $phoneNumber = null
    ): self {
        $obj = new self;

        $obj->email = $email;
        $obj->name = $name;

        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;

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

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phoneNumber = $phoneNumber;

        return $obj;
    }
}
