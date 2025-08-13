<?php

declare(strict_types=1);

namespace DodoPayments\Discounts;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * GET /discounts.
 *
 * @phpstan-type list_params = array{pageNumber?: int, pageSize?: int}
 */
final class DiscountListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Page number (default = 0).
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size (default = 10, max = 100).
     */
    #[Api(optional: true)]
    public ?int $pageSize;

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
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $obj = new self;

        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Page number (default = 0).
     */
    public function setPageNumber(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Page size (default = 10, max = 100).
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }
}
