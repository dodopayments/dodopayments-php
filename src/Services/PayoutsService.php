<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Payouts\PayoutListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PayoutsContract;

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
     * @param string|\DateTimeInterface $createdAtGte Get payouts created after this time (inclusive)
     * @param string|\DateTimeInterface $createdAtLte Get payouts created before this time (inclusive)
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<PayoutListResponse>
     *
     * @throws APIException
     */
    public function list(
        string|\DateTimeInterface|null $createdAtGte = null,
        string|\DateTimeInterface|null $createdAtLte = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
