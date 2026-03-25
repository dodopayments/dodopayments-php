<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Groups\Items\ItemCreateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductShape = array{productID: string, status?: bool|null}
 */
final class Product implements BaseModel
{
    /** @use SdkModel<ProductShape> */
    use SdkModel;

    /**
     * Product ID to include in the group.
     */
    #[Required('product_id')]
    public string $productID;

    /**
     * Status of the product in this group (defaults to true if not provided).
     */
    #[Optional(nullable: true)]
    public ?bool $status;

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
    public static function with(string $productID, ?bool $status = null): self
    {
        $self = new self;

        $self['productID'] = $productID;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Product ID to include in the group.
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * Status of the product in this group (defaults to true if not provided).
     */
    public function withStatus(?bool $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
