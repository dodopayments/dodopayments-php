<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\BrandsService::update()
 *
 * @phpstan-type BrandUpdateParamsShape = array{
 *   description?: string|null,
 *   imageID?: string|null,
 *   name?: string|null,
 *   statementDescriptor?: string|null,
 *   supportEmail?: string|null,
 *   url?: string|null,
 * }
 */
final class BrandUpdateParams implements BaseModel
{
    /** @use SdkModel<BrandUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    #[Optional('image_id', nullable: true)]
    public ?string $imageID;

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
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $imageID && $self['imageID'] = $imageID;
        null !== $name && $self['name'] = $name;
        null !== $statementDescriptor && $self['statementDescriptor'] = $statementDescriptor;
        null !== $supportEmail && $self['supportEmail'] = $supportEmail;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The UUID you got back from the presigned‐upload call.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withStatementDescriptor(?string $statementDescriptor): self
    {
        $self = clone $this;
        $self['statementDescriptor'] = $statementDescriptor;

        return $self;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $self = clone $this;
        $self['supportEmail'] = $supportEmail;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
