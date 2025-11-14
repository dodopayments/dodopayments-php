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
 *   metadata?: array<string,string>|null,
 *   name?: string|null,
 *   phone_number?: string|null,
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    /** @use SdkModel<CustomerUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Additional metadata for the customer.
     *
     * @var array<string,string>|null $metadata
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $metadata;

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
     *
     * @param array<string,string>|null $metadata
     */
    public static function with(
        ?array $metadata = null,
        ?string $name = null,
        ?string $phone_number = null
    ): self {
        $obj = new self;

        null !== $metadata && $obj->metadata = $metadata;
        null !== $name && $obj->name = $name;
        null !== $phone_number && $obj->phone_number = $phone_number;

        return $obj;
    }

    /**
     * Additional metadata for the customer.
     *
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

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
