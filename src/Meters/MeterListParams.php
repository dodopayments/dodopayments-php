<?php

declare(strict_types=1);

namespace Dodopayments\Meters;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new MeterListParams); // set properties as needed
 * $client->meters->list(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->meters->list(...$params->toArray());`
 *
 * @see Dodopayments\Meters->list
 *
 * @phpstan-type meter_list_params = array{
 *   archived?: bool, pageNumber?: int, pageSize?: int
 * }
 */
final class MeterListParams implements BaseModel
{
    /** @use SdkModel<meter_list_params> */
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
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

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
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $obj = new self;

        null !== $archived && $obj->archived = $archived;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;

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
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }
}
