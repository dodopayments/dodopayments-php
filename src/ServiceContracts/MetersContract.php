<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type MeterAggregationShape from \Dodopayments\Meters\MeterAggregation
 * @phpstan-import-type MeterFilterShape from \Dodopayments\Meters\MeterFilter
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface MetersContract
{
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
    ): Meter;

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?string $locale = null,
        RequestOptions|array|null $requestOptions = null,
    ): Meter;

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param string|null $description Description of the meter. Send `null` to remove the description. Omit it to keep it.
     * @param string|null $measurementUnit Measurement unit
     * @param string|null $name Name of the meter
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $description = null,
        ?string $measurementUnit = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): Meter;

    /**
     * @api
     *
     * @param bool $archived List archived meters
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
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
        ?string $locale = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

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
    ): mixed;

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
    ): mixed;
}
