<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use Dodopayments\Meters\MeterCreateParams;
use Dodopayments\Meters\MeterListParams;
use Dodopayments\Meters\MeterRetrieveParams;
use Dodopayments\Meters\MeterUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface MetersRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MeterCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function create(
        array|MeterCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param array<string,mixed>|MeterRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        array|MeterRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Meter ID
     * @param array<string,mixed>|MeterUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Meter>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|MeterUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MeterListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Meter>>
     *
     * @throws APIException
     */
    public function list(
        array|MeterListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

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
    ): BaseResponse;

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
    ): BaseResponse;
}
