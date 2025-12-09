<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageEventIngestResponseShape = array{ingested_count: int}
 */
final class UsageEventIngestResponse implements BaseModel
{
    /** @use SdkModel<UsageEventIngestResponseShape> */
    use SdkModel;

    #[Api]
    public int $ingested_count;

    /**
     * `new UsageEventIngestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageEventIngestResponse::with(ingested_count: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageEventIngestResponse)->withIngestedCount(...)
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
    public static function with(int $ingested_count): self
    {
        $obj = new self;

        $obj['ingested_count'] = $ingested_count;

        return $obj;
    }

    public function withIngestedCount(int $ingestedCount): self
    {
        $obj = clone $this;
        $obj['ingested_count'] = $ingestedCount;

        return $obj;
    }
}
