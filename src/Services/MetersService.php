<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterAggregation\Type;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterFilter\Conjunction;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MetersContract;

final class MetersService implements MetersContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   aggregation: array{
     *     type: 'count'|'sum'|'max'|'last'|Type, key?: string|null
     *   }|MeterAggregation,
     *   event_name: string,
     *   measurement_unit: string,
     *   name: string,
     *   description?: string|null,
     *   filter?: array{
     *     clauses: list<array<mixed>>|list<array<mixed>>,
     *     conjunction: 'and'|'or'|Conjunction,
     *   }|MeterFilter|null,
     * }|MeterCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Meter {
        [$parsed, $options] = MeterCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<Meter> */
        $response = $this->client->request(
            method: 'post',
            path: 'meters',
            body: (object) $parsed,
            options: $options,
            convert: Meter::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Meter {
        /** @var BaseResponse<Meter> */
        $response = $this->client->request(
            method: 'get',
            path: ['meters/%1$s', $id],
            options: $requestOptions,
            convert: Meter::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   archived?: bool, page_number?: int, page_size?: int
     * }|MeterListParams $params
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = MeterListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<Meter>> */
        $response = $this->client->request(
            method: 'get',
            path: 'meters',
            query: $parsed,
            options: $options,
            convert: Meter::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['meters/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'post',
            path: ['meters/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }
}
