<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams;
use Dodopayments\Products\ProductListParams;
use Dodopayments\Products\ProductListResponse;
use Dodopayments\Products\ProductUpdateFilesParams;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\Products\ProductUpdateParams;
use Dodopayments\RequestOptions;

interface ProductsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|ProductCreateParams $params
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Id
     *
     * @return BaseResponse<Product>
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
     * @param array<mixed>|ProductUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|ProductListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
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
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<mixed>|ProductUpdateFilesParams $params
     *
     * @return BaseResponse<ProductUpdateFilesResponse>
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
