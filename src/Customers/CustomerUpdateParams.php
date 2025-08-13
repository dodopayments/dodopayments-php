<?php

declare(strict_types=1);

namespace DodoPayments\Customers;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_params = array{
 *   name?: string|null, phoneNumber?: string|null
 * }
 */
final class CustomerUpdateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('phone_number', optional: true)]
    public ?string $phoneNumber;

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
    public static function from(
        ?string $name = null,
        ?string $phoneNumber = null
    ): self {
        $obj = new self;

        null !== $name && $obj->name = $name;
        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;

        return $obj;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
