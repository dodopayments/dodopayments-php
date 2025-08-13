<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type list_params = array{
 *   archived?: bool,
 *   brandID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   recurring?: bool,
 * }
 */
final class ProductListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * List archived products.
     */
    #[Api(optional: true)]
    public ?bool $archived;

    /**
     * filter by Brand id.
     */
    #[Api(optional: true)]
    public ?string $brandID;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    #[Api(optional: true)]
    public ?bool $recurring;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
        ?bool $archived = null,
        ?string $brandID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?bool $recurring = null,
    ): self {
        $obj = new self;

        null !== $archived && $obj->archived = $archived;
        null !== $brandID && $obj->brandID = $brandID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $recurring && $obj->recurring = $recurring;

        return $obj;
    }

    /**
     * List archived products.
     */
    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * filter by Brand id.
     */
    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    /**
     * Page number default is 0.
     */
    public function setPageNumber(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * Filter products by pricing type:
     * - `true`: Show only recurring pricing products (e.g. subscriptions)
     * - `false`: Show only one-time price products
     * - `null` or absent: Show both types of products
     */
    public function setRecurring(bool $recurring): self
    {
        $this->recurring = $recurring;

        return $this;
    }
}
