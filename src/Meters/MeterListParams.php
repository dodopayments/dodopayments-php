<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\MetersService::list()
 *
 * @phpstan-type MeterListParamsShape = array{
 *   archived?: bool, page_number?: int, page_size?: int
 * }
 */
final class MeterListParams implements BaseModel
{
    /** @use SdkModel<MeterListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * List archived meters.
     */
    #[Api(optional: true)]
    public ?bool $archived;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $page_size;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?bool $archived = null,
        ?int $page_number = null,
        ?int $page_size = null
    ): self {
        $obj = new self;

        null !== $archived && $obj->archived = $archived;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;

        return $obj;
    }

    /**
     * List archived meters.
     */
    public function withArchived(bool $archived): self
    {
        $obj = clone $this;
        $obj->archived = $archived;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->page_number = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }
}
