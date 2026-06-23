<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Products\LocalizedPricesService::archive()
 *
 * @phpstan-type LocalizedPriceArchiveParamsShape = array{productID: string}
 */
final class LocalizedPriceArchiveParams implements BaseModel
{
    /** @use SdkModel<LocalizedPriceArchiveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $productID;

    /**
     * `new LocalizedPriceArchiveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocalizedPriceArchiveParams::with(productID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocalizedPriceArchiveParams)->withProductID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $productID): self
    {
        $self = new self;

        $self['productID'] = $productID;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }
}
