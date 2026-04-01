<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Payouts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Payouts\Breakup\BreakupGetResponseItem;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface BreakupContract
{
    /**
     * @api
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @return list<BreakupGetResponseItem>
     *
     * @throws APIException
     */
    public function retrieve(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): array;
}
