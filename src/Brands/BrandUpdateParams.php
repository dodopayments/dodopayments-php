<?php

declare(strict_types=1);

namespace DodoPayments\Brands;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_params = array{
 *   imageID?: string|null,
 *   name?: string|null,
 *   statementDescriptor?: string|null,
 *   supportEmail?: string|null,
 * }
 */
final class BrandUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    #[Api('image_id', optional: true)]
    public ?string $imageID;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('statement_descriptor', optional: true)]
    public ?string $statementDescriptor;

    #[Api('support_email', optional: true)]
    public ?string $supportEmail;

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
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
    ): self {
        $obj = new self;

        null !== $imageID && $obj->imageID = $imageID;
        null !== $name && $obj->name = $name;
        null !== $statementDescriptor && $obj->statementDescriptor = $statementDescriptor;
        null !== $supportEmail && $obj->supportEmail = $supportEmail;

        return $obj;
    }

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    public function setImageID(?string $imageID): self
    {
        $this->imageID = $imageID;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStatementDescriptor(?string $statementDescriptor): self
    {
        $this->statementDescriptor = $statementDescriptor;

        return $this;
    }

    public function setSupportEmail(?string $supportEmail): self
    {
        $this->supportEmail = $supportEmail;

        return $this;
    }
}
