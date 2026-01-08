<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PayoutsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class PayoutsService implements PayoutsContract
{
    /**
     * @api
     */
    public PayoutsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PayoutsRawService($client);
    }

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get payouts created after this time (inclusive)
     * @param \DateTimeInterface $createdAtLte Get payouts created before this time (inclusive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?\DateTimeInterface $createdAtGte = null,
        ?\DateTimeInterface $createdAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'createdAtGte' => $createdAtGte,
                'createdAtLte' => $createdAtLte,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
