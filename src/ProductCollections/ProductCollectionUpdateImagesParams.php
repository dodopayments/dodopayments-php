<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollectionsService::updateImages()
 *
 * @phpstan-type ProductCollectionUpdateImagesParamsShape = array{
 *   forceUpdate?: bool|null
 * }
 */
final class ProductCollectionUpdateImagesParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionUpdateImagesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If true, generates a new image ID to force cache invalidation.
     */
    #[Optional(nullable: true)]
    public ?bool $forceUpdate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $forceUpdate = null): self
    {
        $self = new self;

        null !== $forceUpdate && $self['forceUpdate'] = $forceUpdate;

        return $self;
    }

    /**
     * If true, generates a new image ID to force cache invalidation.
     */
    public function withForceUpdate(?bool $forceUpdate): self
    {
        $self = clone $this;
        $self['forceUpdate'] = $forceUpdate;

        return $self;
    }
}
