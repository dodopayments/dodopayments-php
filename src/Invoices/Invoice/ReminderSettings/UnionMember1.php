<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\Invoice\ReminderSettings;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The changes of a draft. A `null` field keeps the business value at finalise.
 *
 * @phpstan-type UnionMember1Shape = array{
 *   kind: 'override',
 *   offsetsMinutes?: list<int>|null,
 *   paused?: bool|null,
 *   remindersEnabled?: bool|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    /** @var 'override' $kind */
    #[Required]
    public string $kind = 'override';

    /** @var list<int>|null $offsetsMinutes */
    #[Optional('offsets_minutes', list: 'int', nullable: true)]
    public ?array $offsetsMinutes;

    #[Optional(nullable: true)]
    public ?bool $paused;

    #[Optional('reminders_enabled', nullable: true)]
    public ?bool $remindersEnabled;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int>|null $offsetsMinutes
     */
    public static function with(
        ?array $offsetsMinutes = null,
        ?bool $paused = null,
        ?bool $remindersEnabled = null,
    ): self {
        $self = new self;

        null !== $offsetsMinutes && $self['offsetsMinutes'] = $offsetsMinutes;
        null !== $paused && $self['paused'] = $paused;
        null !== $remindersEnabled && $self['remindersEnabled'] = $remindersEnabled;

        return $self;
    }

    /**
     * @param 'override' $kind
     */
    public function withKind(string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * @param list<int>|null $offsetsMinutes
     */
    public function withOffsetsMinutes(?array $offsetsMinutes): self
    {
        $self = clone $this;
        $self['offsetsMinutes'] = $offsetsMinutes;

        return $self;
    }

    public function withPaused(?bool $paused): self
    {
        $self = clone $this;
        $self['paused'] = $paused;

        return $self;
    }

    public function withRemindersEnabled(?bool $remindersEnabled): self
    {
        $self = clone $this;
        $self['remindersEnabled'] = $remindersEnabled;

        return $self;
    }
}
