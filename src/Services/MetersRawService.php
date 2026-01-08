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
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MetersRawContract;

/**
 * @phpstan-import-type MeterAggregationShape from \Dodopayments\Meters\MeterAggregation
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
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
     *   aggregation: MeterAggregation|MeterAggregationShape,
     *   eventName: string,
     *   measurementUnit: string,
     *   name: string,
     *   description?: string|null,
     *   filter?: MeterFilter|MeterFilterShape|null,
     * }|MeterCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Meter>>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
        RequestOptions|array|null $requestOptions = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
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
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
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
