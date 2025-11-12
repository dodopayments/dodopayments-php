<?php

declare(strict_types=1);

namespace Dodopayments\Licenses\LicenseActivateResponse;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Related product info. Present if the license key is tied to a product.
 *
 * @phpstan-type ProductShape = array{product_id: string, name?: string|null}
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    /**
     * Unique identifier for the product.
     */
    #[Api]
    public string $product_id;

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
     * Product::with(product_id: ...)
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
    public static function with(string $product_id, ?string $name = null): self
    {
        $obj = new self;

        $obj->product_id = $product_id;

        null !== $name && $obj->name = $name;

        return $obj;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->product_id = $productID;

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
