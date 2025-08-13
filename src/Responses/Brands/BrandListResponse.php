<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Brands;

use DodopaymentsClient\Brands\Brand;
use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\Core\Conversion\ListOf;

/**
 * @phpstan-type brand_list_response_alias = array{items: list<Brand>}
 */
final class BrandListResponse implements BaseModel
{
    use Model;

    /**
     * List of brands for this business.
     *
     * @var list<Brand> $items
     */
    #[Api(type: new ListOf(Brand::class))]
    public array $items;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Brand> $items
     */
    public static function from(array $items): self
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
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
