<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

final class BrandUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    #[Api('image_id', nullable: true, optional: true)]
    public ?string $imageID;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api('statement_descriptor', nullable: true, optional: true)]
    public ?string $statementDescriptor;

    #[Api('support_email', nullable: true, optional: true)]
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
    public static function with(
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
    public function withImageID(?string $imageID): self
    {
        $obj = clone $this;
        $obj->imageID = $imageID;

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
        $obj->statementDescriptor = $statementDescriptor;

        return $obj;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $obj = clone $this;
        $obj->supportEmail = $supportEmail;

        return $obj;
    }
}
