<?php

declare(strict_types=1);

namespace DodoPayments\Disputes;

use DodoPayments\Core\Concerns\Enum;
use DodoPayments\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type dispute_stage_alias = DisputeStage::*
 */
final class DisputeStage implements ConverterSource
{
    use Enum;

    public const PRE_DISPUTE = 'pre_dispute';

    public const DISPUTE = 'dispute';

    public const PRE_ARBITRATION = 'pre_arbitration';
}
