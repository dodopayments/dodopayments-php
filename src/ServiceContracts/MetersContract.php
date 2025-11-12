<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;

interface MetersContract
{
    /**
     * @api
     *
     * @param array<mixed>|MeterCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
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
     * @param array<mixed>|MeterListParams $params
     *
     * @return DefaultPageNumberPagination<Meter>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
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
