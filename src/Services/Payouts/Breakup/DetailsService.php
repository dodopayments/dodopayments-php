<?php

declare(strict_types=1);

namespace Dodopayments\Services\Payouts\Breakup;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\Breakup\Details\DetailListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Payouts\Breakup\DetailsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class DetailsService implements DetailsContract
{
    /**
     * @api
     */
    public DetailsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DetailsRawService($client);
    }

    /**
     * @api
     *
     * Returns paginated individual balance ledger entries for a payout, with each entry's amount pro-rated into the payout's currency. Supports pagination via `page_size` (default 10, max 100) and `page_number` (default 0) query parameters.
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param int $pageNumber Page number (0-indexed). Default: 0.
     * @param int $pageSize Number of items per page. Default: 10, Max: 100.
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<DetailListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $payoutID,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($payoutID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Downloads the complete payout breakup as a CSV file. Each row represents a balance ledger entry with columns: Ledger ID, Event Type, Original Amount, Original Currency, Reference Object ID, Description, Created At, USD Equivalent Amount, and Payout Currency Amount.
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function downloadCsv(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->downloadCsv($payoutID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
