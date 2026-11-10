<?php

declare(strict_types=1);

namespace Dodopayments\Services\Payouts;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Payouts\Breakup\BreakupGetResponseItem;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Payouts\BreakupContract;
use Dodopayments\Services\Payouts\Breakup\DetailsService;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BreakupService implements BreakupContract
{
    /**
     * @api
     */
    public BreakupRawService $raw;

    /**
     * @api
     */
    public DetailsService $details;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BreakupRawService($client);
        $this->details = new DetailsService($client);
    }

    /**
     * @api
     *
     * Returns the breakdown of a payout by event type (payments, refunds, disputes, fees, etc.) in the payout's currency. Each amount is proportionally allocated based on USD equivalent values, ensuring the total sums exactly to the payout amount.
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
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($payoutID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
