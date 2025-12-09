<?php

declare(strict_types=1);

namespace Dodopayments\UsageEvents;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type UsageEventIngestResponseShape = array{ingestedCount: int}
 */
final class UsageEventIngestResponse implements BaseModel
{
    /** @use SdkModel<UsageEventIngestResponseShape> */
    use SdkModel;

    #[Required('ingested_count')]
    public int $ingestedCount;

    /**
     * `new UsageEventIngestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageEventIngestResponse::with(ingestedCount: ...)
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
    public static function with(int $ingestedCount): self
    {
        $obj = new self;

        $obj['ingestedCount'] = $ingestedCount;

        return $obj;
    }

    public function withIngestedCount(int $ingestedCount): self
    {
        $obj = clone $this;
        $obj['ingestedCount'] = $ingestedCount;

        return $obj;
    }
}
