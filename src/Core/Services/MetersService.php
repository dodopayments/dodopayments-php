<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\MetersContract;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class MetersService implements MetersContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param MeterAggregation $aggregation Aggregation configuration for the meter
     * @param string $eventName Event name to track
     * @param string $measurementUnit measurement unit
     * @param string $name Name of the meter
     * @param string|null $description Optional description of the meter
     * @param MeterFilter $filter Optional filter to apply to the meter
     */
    public function create(
        $aggregation,
        $eventName,
        $measurementUnit,
        $name,
        $description = omit,
        $filter = omit,
        ?RequestOptions $requestOptions = null,
    ): Meter {
        [$parsed, $options] = MeterCreateParams::parseRequest(
            [
                'aggregation' => $aggregation,
                'eventName' => $eventName,
                'measurementUnit' => $measurementUnit,
                'name' => $name,
                'description' => $description,
                'filter' => $filter,
            ],
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
     * @param bool $archived List archived meters
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<Meter>
     */
    public function list(
        $archived = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = MeterListParams::parseRequest(
            [
                'archived' => $archived,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
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
     */
    public function delete(
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
