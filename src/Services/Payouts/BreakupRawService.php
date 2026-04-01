<?php

declare(strict_types=1);

namespace Dodopayments\Services\Payouts;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Payouts\Breakup\BreakupGetResponseItem;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Payouts\BreakupRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BreakupRawService implements BreakupRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the breakdown of a payout by event type (payments, refunds, disputes, fees, etc.) in the payout's currency. Each amount is proportionally allocated based on USD equivalent values, ensuring the total sums exactly to the payout amount.
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<BreakupGetResponseItem>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payouts/%1$s/breakup', $payoutID],
            options: $requestOptions,
            convert: new ListOf(BreakupGetResponseItem::class),
        );
    }
}
