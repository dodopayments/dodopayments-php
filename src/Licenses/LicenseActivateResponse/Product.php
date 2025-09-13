<?php

declare(strict_types=1);

namespace Dodopayments\Licenses\LicenseActivateResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Related product info. Present if the license key is tied to a product.
 *
 * @phpstan-type product_alias = array{productID: string, name?: string|null}
 */
final class Product implements BaseModel
{
    /** @use SdkModel<product_alias> */
    use SdkModel;

    /**
     * Unique identifier for the product.
     */
    #[Api('product_id')]
    public string $productID;

    /**
     * Name of the product, if set by the merchant.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * `new Product()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Product::with(productID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Product)->withProductID(...)
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
    public static function with(string $productID, ?string $name = null): self
    {
        $obj = new self;

        $obj->productID = $productID;

        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    /**
     * Name of the product, if set by the merchant.
     */
    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
