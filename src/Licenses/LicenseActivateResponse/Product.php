<?php

declare(strict_types=1);

namespace Dodopayments\Licenses\LicenseActivateResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Related product info. Present if the license key is tied to a product.
 *
 * @phpstan-type ProductShape = array{productID: string, name?: string|null}
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    /**
     * Unique identifier for the product.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Name of the product, if set by the merchant.
     */
    #[Optional(nullable: true)]
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
        $self = new self;

        $self['productID'] = $productID;

        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Unique identifier for the product.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Name of the product, if set by the merchant.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
