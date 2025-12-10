<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterAggregation;
use Dodopayments\Meters\MeterAggregation\Type;
use Dodopayments\Meters\MeterFilter;
use Dodopayments\Meters\MeterFilter\Clauses\DirectFilterCondition\Operator;
use Dodopayments\Meters\MeterFilter\Clauses\NestedMeterFilter\Clauses\Level1NestedFilter\Clauses\Level2NestedFilter\Conjunction;
use Dodopayments\RequestOptions;

interface MetersContract
{
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
    ): Meter;

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
        ?bool $archived = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

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
    ): mixed;

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
    ): mixed;
}
