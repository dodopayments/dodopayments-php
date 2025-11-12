<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Brands->create
 *
 * @phpstan-type BrandCreateParamsShape = array{
 *   description?: string|null,
 *   name?: string|null,
 *   statement_descriptor?: string|null,
 *   support_email?: string|null,
 *   url?: string|null,
 * }
 */
final class BrandCreateParams implements BaseModel
{
    /** @use SdkModel<BrandCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $statement_descriptor;

    #[Api(nullable: true, optional: true)]
    public ?string $support_email;

    #[Api(nullable: true, optional: true)]
    public ?string $url;

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
        ?string $description = null,
        ?string $name = null,
        ?string $statement_descriptor = null,
        ?string $support_email = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $description && $obj->description = $description;
        null !== $name && $obj->name = $name;
        null !== $statement_descriptor && $obj->statement_descriptor = $statement_descriptor;
        null !== $support_email && $obj->support_email = $support_email;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

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

    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
