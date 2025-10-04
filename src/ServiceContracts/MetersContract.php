<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface MetersContract
{
    /**
     * @api
     *
     * @param MeterAggregation $aggregation Aggregation configuration for the meter
     * @param string $eventName Event name to track
     * @param string $measurementUnit measurement unit
     * @param string $name Name of the meter
     * @param string|null $description Optional description of the meter
     * @param MeterFilter|null $filter Optional filter to apply to the meter
     *
     * @throws APIException
     */
    public function create(
        $aggregation,
        $eventName,
        $measurementUnit,
        $name,
        $description = omit,
        $filter = omit,
        ?RequestOptions $requestOptions = null,
    ): Meter;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): Meter;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Meter;

    /**
     * @api
     *
     * @param bool $archived List archived meters
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function list(
        $archived = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
