<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Products\LocalizedPrices\ListLocalizedPricesResponse;
use Dodopayments\Products\LocalizedPrices\LocalizedPrice;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceArchiveParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceCreateParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceRetrieveParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LocalizedPricesRawContract
{
    /**
     * @api
     *
     * @param string $productID Product Id
     * @param array<string,mixed>|LocalizedPriceCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LocalizedPrice>
     *
     * @throws APIException
     */
    public function create(
        string $productID,
        array|LocalizedPriceCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param array<string,mixed>|LocalizedPriceRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LocalizedPrice>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        array|LocalizedPriceRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Path param: Localized Price Id
     * @param array<string,mixed>|LocalizedPriceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LocalizedPrice>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LocalizedPriceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $productID Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ListLocalizedPricesResponse>
     *
     * @throws APIException
     */
    public function list(
        string $productID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param array<string,mixed>|LocalizedPriceArchiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        array|LocalizedPriceArchiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
