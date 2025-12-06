<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NewCustomerShape = array{
 *   email: string, name?: string|null, phone_number?: string|null
 * }
 */
final class NewCustomer implements BaseModel
{
    /** @use SdkModel<NewCustomerShape> */
    use SdkModel;

    /**
     * Email is required for creating a new customer.
     */
    #[Api]
    public string $email;

    /**
     * Optional full name of the customer. If provided during session creation,
     * it is persisted and becomes immutable for the session. If omitted here,
     * it can be provided later via the confirm API.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

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
        ?string $phone_number = null
    ): self {
        $obj = new self;

        $obj['email'] = $email;

        null !== $name && $obj['name'] = $name;
        null !== $phone_number && $obj['phone_number'] = $phone_number;

        return $obj;
    }

    /**
     * Email is required for creating a new customer.
     */
    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj['email'] = $email;

        return $obj;
    }

    /**
     * Optional full name of the customer. If provided during session creation,
     * it is persisted and becomes immutable for the session. If omitted here,
     * it can be provided later via the confirm API.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $obj = clone $this;
        $obj['phone_number'] = $phoneNumber;

        return $obj;
    }
}
