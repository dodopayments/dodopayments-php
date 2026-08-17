<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\BrandsService::list()
 *
 * @phpstan-type BrandListParamsShape = array{includeArchived?: bool|null}
 */
final class BrandListParams implements BaseModel
{
    /** @use SdkModel<BrandListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Set to true to also list archived brands. Default false.
     */
    #[Optional]
    public ?bool $includeArchived;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $includeArchived = null): self
    {
        $self = new self;

        null !== $includeArchived && $self['includeArchived'] = $includeArchived;

        return $self;
    }

    /**
     * Set to true to also list archived brands. Default false.
     */
    public function withIncludeArchived(bool $includeArchived): self
    {
        $self = clone $this;
        $self['includeArchived'] = $includeArchived;

        return $self;
    }
}
