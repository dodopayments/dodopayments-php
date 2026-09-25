<?php

declare(strict_types=1);

namespace Dodopayments\Moderation\ModerationGetUsageResponse;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type DailyShape = array{date: string, screens: int}
 */
final class Daily implements BaseModel
{
    /** @use SdkModel<DailyShape> */
    use SdkModel;

    /**
     * The UTC day.
     */
    #[Required]
    public string $date;

    /**
     * Billable screens on that day.
     */
    #[Required]
    public int $screens;

    /**
     * `new Daily()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Daily::with(date: ..., screens: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Daily)->withDate(...)->withScreens(...)
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
    public static function with(string $date, int $screens): self
    {
        $self = new self;

        $self['date'] = $date;
        $self['screens'] = $screens;

        return $self;
    }

    /**
     * The UTC day.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Billable screens on that day.
     */
    public function withScreens(int $screens): self
    {
        $self = clone $this;
        $self['screens'] = $screens;

        return $self;
    }
}
