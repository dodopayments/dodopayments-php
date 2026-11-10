<?php

declare(strict_types=1);

namespace Dodopayments\Invoices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Invoices\InvoiceUpdateDunningParams\Action;

/**
 * Pauses, resumes or moves the reminders of an open or past-due invoice.
 *
 * @see Dodopayments\Services\InvoicesService::updateDunning()
 *
 * @phpstan-type InvoiceUpdateDunningParamsShape = array{
 *   action: Action|value-of<Action>, ifMatch: string, offsetsDays?: list<int>|null
 * }
 */
final class InvoiceUpdateDunningParams implements BaseModel
{
    /** @use SdkModel<InvoiceUpdateDunningParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<Action> $action */
    #[Required(enum: Action::class)]
    public string $action;

    #[Required]
    public string $ifMatch;

    /**
     * Needed for `reschedule`. Days from the due date.
     *
     * @var list<int>|null $offsetsDays
     */
    #[Optional('offsets_days', list: 'int', nullable: true)]
    public ?array $offsetsDays;

    /**
     * `new InvoiceUpdateDunningParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvoiceUpdateDunningParams::with(action: ..., ifMatch: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvoiceUpdateDunningParams)->withAction(...)->withIfMatch(...)
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
     * @param Action|value-of<Action> $action
     * @param list<int>|null $offsetsDays
     */
    public static function with(
        Action|string $action,
        string $ifMatch,
        ?array $offsetsDays = null
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['ifMatch'] = $ifMatch;

        null !== $offsetsDays && $self['offsetsDays'] = $offsetsDays;

        return $self;
    }

    /**
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    public function withIfMatch(string $ifMatch): self
    {
        $self = clone $this;
        $self['ifMatch'] = $ifMatch;

        return $self;
    }

    /**
     * Needed for `reschedule`. Days from the due date.
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
