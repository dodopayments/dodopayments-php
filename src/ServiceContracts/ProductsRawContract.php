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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ProductsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProductCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProductUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProductListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
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

    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<string,mixed>|ProductUpdateFilesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductUpdateFilesResponse>
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
