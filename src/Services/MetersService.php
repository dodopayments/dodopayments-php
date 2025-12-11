<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterAggregation\Type;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition\Operator;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Conjunction;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\MetersContract;

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
     * @param array{
     *   type: 'count'|'sum'|'max'|'last'|Type, key?: string|null
     * }|MeterAggregation $aggregation Aggregation configuration for the meter
     * @param string $eventName Event name to track
     * @param string $measurementUnit measurement unit
     * @param string $name Name of the meter
     * @param string|null $description Optional description of the meter
     * @param array{
     *   clauses: list<array{
     *     key: string,
     *     operator: 'equals'|'not_equals'|'greater_than'|'greater_than_or_equals'|'less_than'|'less_than_or_equals'|'contains'|'does_not_contain'|Operator,
     *     value: string|float|bool,
     *   }>|list<array{
     *     clauses: list<array{
     *       key: string,
     *       operator: 'equals'|'not_equals'|'greater_than'|'greater_than_or_equals'|'less_than'|'less_than_or_equals'|'contains'|'does_not_contain'|MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1FilterCondition\Operator,
     *       value: string|float|bool,
     *     }>|list<array{
     *       clauses: list<array{
     *         key: string,
     *         operator: 'equals'|'not_equals'|'greater_than'|'greater_than_or_equals'|'less_than'|'less_than_or_equals'|'contains'|'does_not_contain'|MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2FilterCondition\Operator,
     *         value: string|float|bool,
     *       }>|list<array{
     *         clauses: list<array{
     *           key: string,
     *           operator: 'equals'|'not_equals'|'greater_than'|'greater_than_or_equals'|'less_than'|'less_than_or_equals'|'contains'|'does_not_contain'|MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Clause\Operator,
     *           value: string|float|bool,
     *         }>,
     *         conjunction: 'and'|'or'|Conjunction,
     *       }>,
     *       conjunction: 'and'|'or'|MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Conjunction,
     *     }>,
     *     conjunction: 'and'|'or'|MeterFilter\Clauses\NestedMeterFilter\Conjunction,
     *   }>,
     *   conjunction: 'and'|'or'|MeterFilter\Conjunction,
     * }|MeterFilter|null $filter Optional filter to apply to the meter
     *
     * @throws APIException
     */
    public function create(
        array|MeterAggregation $aggregation,
        string $eventName,
        string $measurementUnit,
        string $name,
        ?string $description = null,
        array|MeterFilter|null $filter = null,
        ?RequestOptions $requestOptions = null,
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
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
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
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
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
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Meter ID
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unarchive($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
