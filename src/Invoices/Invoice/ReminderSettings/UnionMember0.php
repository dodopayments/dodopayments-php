<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\ReminderSettings;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The settings that finalise froze. The reminders run on them.
 *
 * @phpstan-type UnionMember0Shape = array{
 *   kind: 'snapshot',
 *   offsetsMinutes: list<int>,
 *   paused: bool,
 *   remindersEnabled: bool,
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    /** @var 'snapshot' $kind */
    #[Required]
    public string $kind = 'snapshot';

    /** @var list<int> $offsetsMinutes */
    #[Required('offsets_minutes', list: 'int')]
    public array $offsetsMinutes;

    #[Required]
    public bool $paused;

    #[Required('reminders_enabled')]
    public bool $remindersEnabled;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(offsetsMinutes: ..., paused: ..., remindersEnabled: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)
     *   ->withOffsetsMinutes(...)
     *   ->withPaused(...)
     *   ->withRemindersEnabled(...)
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
     * @param list<int> $offsetsMinutes
     */
    public static function with(
        array $offsetsMinutes,
        bool $paused,
        bool $remindersEnabled
    ): self {
        $self = new self;

        $self['offsetsMinutes'] = $offsetsMinutes;
        $self['paused'] = $paused;
        $self['remindersEnabled'] = $remindersEnabled;

        return $self;
    }

    /**
     * @param 'snapshot' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * @param list<int> $offsetsMinutes
     */
    public function withOffsetsMinutes(array $offsetsMinutes): self
    {
        $self = clone $this;
        $self['offsetsMinutes'] = $offsetsMinutes;

        return $self;
    }

    public function withPaused(bool $paused): self
    {
        $self = clone $this;
        $self['paused'] = $paused;

        return $self;
    }

    public function withRemindersEnabled(bool $remindersEnabled): self
    {
        $self = clone $this;
        $self['remindersEnabled'] = $remindersEnabled;

        return $self;
    }
}
