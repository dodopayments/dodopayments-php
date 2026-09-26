<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Moderation\ModerationGetUsageResponse\Daily;

/**
 * Your moderation usage.
 *
 * @phpstan-import-type DailyShape from \Dodopayments\Moderation\ModerationGetUsageResponse\Daily
 *
 * @phpstan-type ModerationGetUsageResponseShape = array{
 *   daily: list<Daily|DailyShape>, screensToNextBlock: int, unbilledScreens: int
 * }
 */
final class ModerationGetUsageResponse implements BaseModel
{
    /** @use SdkModel<ModerationGetUsageResponseShape> */
    use SdkModel;

    /**
     * Your billable screens per UTC day for the last 30 days, charged or not. A day with no
     * screens is not in the list.
     *
     * @var list<Daily> $daily
     */
    #[Required(list: Daily::class)]
    public array $daily;

    /**
     * Billable screens still needed to fill the next block of 1000. A full block is charged
     * within one hour, so this value is 1000 when your unbilled screens fill whole blocks.
     */
    #[Required('screens_to_next_block')]
    public int $screensToNextBlock;

    /**
     * Billable screens that Dodo Payments has not charged for yet.
     */
    #[Required('unbilled_screens')]
    public int $unbilledScreens;

    /**
     * `new ModerationGetUsageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModerationGetUsageResponse::with(
     *   daily: ..., screensToNextBlock: ..., unbilledScreens: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModerationGetUsageResponse)
     *   ->withDaily(...)
     *   ->withScreensToNextBlock(...)
     *   ->withUnbilledScreens(...)
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
     *
     * @param list<Daily|DailyShape> $daily
     */
    public static function with(
        array $daily,
        int $screensToNextBlock,
        int $unbilledScreens
    ): self {
        $self = new self;

        $self['daily'] = $daily;
        $self['screensToNextBlock'] = $screensToNextBlock;
        $self['unbilledScreens'] = $unbilledScreens;

        return $self;
    }

    /**
     * Your billable screens per UTC day for the last 30 days, charged or not. A day with no
     * screens is not in the list.
     *
     * @param list<Daily|DailyShape> $daily
     */
    public function withDaily(array $daily): self
    {
        $self = clone $this;
        $self['daily'] = $daily;

        return $self;
    }

    /**
     * Billable screens still needed to fill the next block of 1000. A full block is charged
     * within one hour, so this value is 1000 when your unbilled screens fill whole blocks.
     */
    public function withScreensToNextBlock(int $screensToNextBlock): self
    {
        $self = clone $this;
        $self['screensToNextBlock'] = $screensToNextBlock;

        return $self;
    }

    /**
     * Billable screens that Dodo Payments has not charged for yet.
     */
    public function withUnbilledScreens(int $unbilledScreens): self
    {
        $self = clone $this;
        $self['unbilledScreens'] = $unbilledScreens;

        return $self;
    }
}
