<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterFilter;
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
     *     type: 'count'|'sum'|'max'|'last', key?: string|null
     *   }|MeterAggregation,
     *   event_name: string,
     *   measurement_unit: string,
     *   name: string,
     *   description?: string|null,
     *   filter?: array{
     *     clauses: list<array<mixed>>|list<array<mixed>>, conjunction: 'and'|'or'
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

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Meter {
        // @phpstan-ignore-next-line;
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

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'meters',
            query: $parsed,
            options: $options,
            convert: Meter::class,
            page: DefaultPageNumberPagination::class,
        );
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
        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['meters/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
