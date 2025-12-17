<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\RequestOptions;

interface MetersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MeterCreateParams $params
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MeterListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Meter>>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

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
    ): BaseResponse;

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
    ): BaseResponse;
}
