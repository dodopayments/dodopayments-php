<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\BrandsService::create()
 *
 * @phpstan-type BrandCreateParamsShape = array{
 *   description?: string|null,
 *   name?: string|null,
 *   statementDescriptor?: string|null,
 *   supportEmail?: string|null,
 *   url?: string|null,
 * }
 */
final class BrandCreateParams implements BaseModel
{
    /** @use SdkModel<BrandCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional('statement_descriptor', nullable: true)]
    public ?string $statementDescriptor;

    #[Optional('support_email', nullable: true)]
    public ?string $supportEmail;

    #[Optional(nullable: true)]
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
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $description && $obj['description'] = $description;
        null !== $name && $obj['name'] = $name;
        null !== $statementDescriptor && $obj['statementDescriptor'] = $statementDescriptor;
        null !== $supportEmail && $obj['supportEmail'] = $supportEmail;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withStatementDescriptor(?string $statementDescriptor): self
    {
        $obj = clone $this;
        $obj['statementDescriptor'] = $statementDescriptor;

        return $obj;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $obj = clone $this;
        $obj['supportEmail'] = $supportEmail;

        return $obj;
    }

    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
