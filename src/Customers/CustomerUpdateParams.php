<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Customers->update
 *
 * @phpstan-type customer_update_params = array{
 *   name?: string|null, phoneNumber?: string|null
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    /** @use SdkModel<customer_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api('phone_number', nullable: true, optional: true)]
    public ?string $phoneNumber;

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
        ?string $name = null,
        ?string $phoneNumber = null
    ): self {
        $obj = new self;

        null !== $name && $obj->name = $name;
        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;

        return $obj;
    }

    public function withName(?string $name): self
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
