<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

/**
 * Controls how overage is handled at the end of a billing cycle.
 *
 * | Preset                  | Charge at billing | Credits reduce overage | Preserve overage at reset |
 * |-------------------------|:-----------------:|:---------------------:|:-------------------------:|
 * | `forgive_at_reset`      | No                | No                    | No                        |
 * | `invoice_at_billing`    | Yes               | No                    | No                        |
 * | `carry_deficit`         | No                | No                    | Yes                       |
 * | `carry_deficit_auto_repay` | No             | Yes                   | Yes                       |
 */
enum CbbOverageBehavior: string
{
    case FORGIVE_AT_RESET = 'forgive_at_reset';

    case INVOICE_AT_BILLING = 'invoice_at_billing';

    case CARRY_DEFICIT = 'carry_deficit';

    case CARRY_DEFICIT_AUTO_REPAY = 'carry_deficit_auto_repay';
}
