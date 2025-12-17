<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterAggregation\Type;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterFilter\Conjunction;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MetersRawContract;

final class MetersRawService implements MetersRawContract
{
    // @phpstan-ignore-next-line
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
     *   eventName: string,
     *   measurementUnit: string,
     *   name: string,
     *   description?: string|null,
     *   filter?: array{
     *     clauses: list<array<string,mixed>>|list<array<string,mixed>>,
     *     conjunction: 'and'|'or'|Conjunction,
     *   }|MeterFilter|null,
     * }|MeterCreateParams $params
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = MeterCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'meters',
            body: (object) $parsed,
            options: $options,
            convert: Meter::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['meters/%1$s', $id],
            options: $requestOptions,
            convert: Meter::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   archived?: bool, pageNumber?: int, pageSize?: int
     * }|MeterListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Meter>>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = MeterListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'meters',
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: Meter::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['meters/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['meters/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
