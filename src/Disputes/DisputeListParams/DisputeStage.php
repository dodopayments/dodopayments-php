<?php

declare(strict_types=1);

namespace Dodopayments\Disputes\DisputeListParams;

use Dodopayments\Core\Concerns\SdkEnum;
use Dodopayments\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by dispute stage.
 *
 * @phpstan-type dispute_stage_alias = DisputeStage::*
 */
final class DisputeStage implements ConverterSource
{
    use SdkEnum;

    public const PRE_DISPUTE = 'pre_dispute';

    public const DISPUTE = 'dispute';

    public const PRE_ARBITRATION = 'pre_arbitration';
}
