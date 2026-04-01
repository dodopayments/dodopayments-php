<?php

declare(strict_types=1);

namespace Dodopayments\Services\Payouts\Breakup;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\Breakup\Details\DetailListParams;
use Dodopayments\Payouts\Breakup\Details\DetailListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Payouts\Breakup\DetailsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class DetailsRawService implements DetailsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns paginated individual balance ledger entries for a payout, with each entry's amount pro-rated into the payout's currency. Supports pagination via `page_size` (default 10, max 100) and `page_number` (default 0) query parameters.
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param array{pageNumber?: int, pageSize?: int}|DetailListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<DetailListResponse>>
     *
     * @throws APIException
     */
    public function list(
        string $payoutID,
        array|DetailListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DetailListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payouts/%1$s/breakup/details', $payoutID],
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: DetailListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * Downloads the complete payout breakup as a CSV file. Each row represents a balance ledger entry with columns: Ledger ID, Event Type, Original Amount, Original Currency, Reference Object ID, Description, Created At, USD Equivalent Amount, and Payout Currency Amount.
     *
     * @param string $payoutID Id of the Payout to get breakup for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function downloadCsv(
        string $payoutID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payouts/%1$s/breakup/details/csv', $payoutID],
            options: $requestOptions,
            convert: null,
        );
    }
}
