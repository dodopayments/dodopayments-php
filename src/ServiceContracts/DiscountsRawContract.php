<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface DiscountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DiscountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function create(
        array|DiscountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param array<string,mixed>|DiscountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        array|DiscountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DiscountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Discount>>
     *
     * @throws APIException
     */
    public function list(
        array|DiscountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $code The discount code (e.g., 'SAVE20')
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function retrieveByCode(
        string $code,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
