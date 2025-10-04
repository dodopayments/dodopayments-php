<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type brand_list_response = array{items: list<Brand>}
 */
final class BrandListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<brand_list_response> */
    use SdkModel;

    use SdkResponse;

    /**
     * List of brands for this business.
     *
     * @var list<Brand> $items
     */
    #[Api(list: Brand::class)]
    public array $items;

    /**
     * `new BrandListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandListResponse)->withItems(...)
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
     *
     * @param list<Brand> $items
     */
    public static function with(array $items): self
    {
        $obj = new self;

        $obj->items = $items;

        return $obj;
    }

    /**
     * List of brands for this business.
     *
     * @param list<Brand> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }
}
