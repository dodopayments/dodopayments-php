<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MetersContract;

/**
 * @phpstan-import-type MeterAggregationShape from \Dodopayments\Meters\MeterAggregation
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class MetersService implements MetersContract
{
    /**
     * @api
     */
    public MetersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MetersRawService($client);
    }

    /**
     * @api
     *
     * @param MeterAggregation|MeterAggregationShape $aggregation Aggregation configuration for the meter
     * @param string $eventName Event name to track
     * @param string $measurementUnit measurement unit
     * @param string $name Name of the meter
     * @param string|null $description Optional description of the meter
     * @param MeterFilter|MeterFilterShape|null $filter Optional filter to apply to the meter
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        MeterAggregation|array $aggregation,
        string $eventName,
        string $measurementUnit,
        string $name,
        ?string $description = null,
        MeterFilter|array|null $filter = null,
        RequestOptions|array|null $requestOptions = null,
    ): Meter {
        $params = Util::removeNulls(
            [
                'aggregation' => $aggregation,
                'eventName' => $eventName,
                'measurementUnit' => $measurementUnit,
                'name' => $name,
                'description' => $description,
                'filter' => $filter,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Meter {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param bool $archived List archived meters
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'archived' => $archived,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unarchive($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
