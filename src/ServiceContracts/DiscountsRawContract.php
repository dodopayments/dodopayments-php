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

interface DiscountsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|DiscountCreateParams $params
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function create(
        array|DiscountCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param array<string,mixed>|DiscountUpdateParams $params
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        array|DiscountUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|DiscountListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<Discount>>
     *
     * @throws APIException
     */
    public function list(
        array|DiscountListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
