<?php

declare(strict_types=1);

namespace Dodopayments\Invoices\InvoiceUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The reminder override of one invoice. The business settings fill the other dunning values.
 *
 * @phpstan-type DunningShape = array{
 *   remindersEnabled: bool, offsetsDays?: list<int>|null
 * }
 */
final class Dunning implements BaseModel
{
    /** @use SdkModel<DunningShape> */
    use SdkModel;

    #[Required('reminders_enabled')]
    public bool $remindersEnabled;

    /**
     * Days from the due date. A negative value sends the reminder before the due date.
     *
     * @var list<int>|null $offsetsDays
     */
    #[Optional('offsets_days', list: 'int', nullable: true)]
    public ?array $offsetsDays;

    /**
     * `new Dunning()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dunning::with(remindersEnabled: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dunning)->withRemindersEnabled(...)
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
     * @param list<int>|null $offsetsDays
     */
    public static function with(
        bool $remindersEnabled,
        ?array $offsetsDays = null
    ): self {
        $self = new self;

        $self['remindersEnabled'] = $remindersEnabled;

        null !== $offsetsDays && $self['offsetsDays'] = $offsetsDays;

        return $self;
    }

    public function withRemindersEnabled(bool $remindersEnabled): self
    {
        $self = clone $this;
        $self['remindersEnabled'] = $remindersEnabled;

        return $self;
    }

    /**
     * Days from the due date. A negative value sends the reminder before the due date.
     *
     * @param list<int>|null $offsetsDays
     */
    public function withOffsetsDays(?array $offsetsDays): self
    {
        $self = clone $this;
        $self['offsetsDays'] = $offsetsDays;

        return $self;
    }
}
