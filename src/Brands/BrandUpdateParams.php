<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Brands->update
 *
 * @phpstan-type BrandUpdateParamsShape = array{
 *   image_id?: string|null,
 *   name?: string|null,
 *   statement_descriptor?: string|null,
 *   support_email?: string|null,
 * }
 */
final class BrandUpdateParams implements BaseModel
{
    /** @use SdkModel<BrandUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $image_id;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $statement_descriptor;

    #[Api(nullable: true, optional: true)]
    public ?string $support_email;

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
        ?string $image_id = null,
        ?string $name = null,
        ?string $statement_descriptor = null,
        ?string $support_email = null,
    ): self {
        $obj = new self;

        null !== $image_id && $obj->image_id = $image_id;
        null !== $name && $obj->name = $name;
        null !== $statement_descriptor && $obj->statement_descriptor = $statement_descriptor;
        null !== $support_email && $obj->support_email = $support_email;

        return $obj;
    }

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj->image_id = $imageID;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withStatementDescriptor(?string $statementDescriptor): self
    {
        $obj = clone $this;
        $obj->statement_descriptor = $statementDescriptor;

        return $obj;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $obj = clone $this;
        $obj->support_email = $supportEmail;

        return $obj;
    }
}
