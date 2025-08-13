<?php

declare(strict_types=1);

namespace DodopaymentsClient\Disputes\DisputeListParams;

use DodopaymentsClient\Core\Concerns\Enum;
use DodopaymentsClient\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by dispute status.
 *
 * @phpstan-type dispute_status_alias = DisputeStatus::*
 */
final class DisputeStatus implements ConverterSource
{
    use Enum;

    public const DISPUTE_OPENED = 'dispute_opened';

    public const DISPUTE_EXPIRED = 'dispute_expired';

    public const DISPUTE_ACCEPTED = 'dispute_accepted';

    public const DISPUTE_CANCELLED = 'dispute_cancelled';

    public const DISPUTE_CHALLENGED = 'dispute_challenged';

    public const DISPUTE_WON = 'dispute_won';

    public const DISPUTE_LOST = 'dispute_lost';
}
