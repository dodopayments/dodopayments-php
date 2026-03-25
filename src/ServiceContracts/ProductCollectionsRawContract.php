<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\ProductCollections\ProductCollectionCreateParams;
use Dodopayments\ProductCollections\ProductCollectionGetResponse;
use Dodopayments\ProductCollections\ProductCollectionListParams;
use Dodopayments\ProductCollections\ProductCollectionListResponse;
use Dodopayments\ProductCollections\ProductCollectionNewResponse;
use Dodopayments\ProductCollections\ProductCollectionUnarchiveResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesParams;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ProductCollectionsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ProductCollectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCollectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionGetResponse>
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
     * @param string $id Product Collection Id
     * @param array<string,mixed>|ProductCollectionUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductCollectionUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProductCollectionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductCollectionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductCollectionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionUnarchiveResponse>
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
     * @param string $id Product Collection Id
     * @param array<string,mixed>|ProductCollectionUpdateImagesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductCollectionUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        array|ProductCollectionUpdateImagesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
