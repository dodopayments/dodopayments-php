<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::update()
 *
 * @phpstan-type CustomerUpdateParamsShape = array{
 *   name?: string|null, phone_number?: string|null
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    /** @use SdkModel<CustomerUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $phone_number;

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
        ?string $phone_number = null
    ): self {
        $obj = new self;

        null !== $name && $obj->name = $name;
        null !== $phone_number && $obj->phone_number = $phone_number;

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
        $obj->phone_number = $phoneNumber;

        return $obj;
    }
}
