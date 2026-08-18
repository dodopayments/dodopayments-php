<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Archive a brand. Its products, live subscriptions, and product collections
 * move to the `move_products_to` brand. Archive is permanent.
 *
 * @see Dodopayments\Services\BrandsService::archive()
 *
 * @phpstan-type BrandArchiveParamsShape = array{moveProductsTo?: string|null}
 */
final class BrandArchiveParams implements BaseModel
{
    /** @use SdkModel<BrandArchiveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Brand that takes over the products and the live subscriptions of the
     * brand you archive. It must be a brand of the same business, and it must
     * not be archived. The primary brand (its brand id is the business id) is
     * a valid target. Omit this field only when the brand holds no products
     * and no live subscriptions.
     */
    #[Optional('move_products_to', nullable: true)]
    public ?string $moveProductsTo;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $moveProductsTo = null): self
    {
        $self = new self;

        null !== $moveProductsTo && $self['moveProductsTo'] = $moveProductsTo;

        return $self;
    }

    /**
     * Brand that takes over the products and the live subscriptions of the
     * brand you archive. It must be a brand of the same business, and it must
     * not be archived. The primary brand (its brand id is the business id) is
     * a valid target. Omit this field only when the brand holds no products
     * and no live subscriptions.
     */
    public function withMoveProductsTo(?string $moveProductsTo): self
    {
        $self = clone $this;
        $self['moveProductsTo'] = $moveProductsTo;

        return $self;
    }
}
