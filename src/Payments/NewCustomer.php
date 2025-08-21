<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type new_customer_alias = array{
 *   email: string, name: string, phoneNumber?: string|null
 * }
 */
final class NewCustomer implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $email;

    #[Api]
    public string $name;

    #[Api('phone_number', optional: true)]
    public ?string $phoneNumber;

    /**
     * `new NewCustomer()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewCustomer::with(email: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewCustomer)->withEmail(...)->withName(...)
     * ```
     */
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
