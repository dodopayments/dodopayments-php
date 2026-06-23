<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\LocalizedPrices\ListLocalizedPricesResponse;
use Dodopayments\Products\LocalizedPrices\LocalizedPrice;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceArchiveParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceCreateParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceRetrieveParams;
use Dodopayments\Products\LocalizedPrices\LocalizedPriceUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\LocalizedPricesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LocalizedPricesRawService implements LocalizedPricesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $productID Product Id
     * @param array{
     *   amount: int, currency: value-of<Currency>, countryCode?: value-of<CountryCode>
     * }|LocalizedPriceCreateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LocalizedPriceCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['products/%1$s/localized-prices', $productID],
            body: (object) $parsed,
            options: $options,
            convert: LocalizedPrice::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param array{productID: string}|LocalizedPriceRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LocalizedPriceRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $productID = $parsed['productID'];
        unset($parsed['productID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['products/%1$s/localized-prices/%2$s', $productID, $id],
            options: $options,
            convert: LocalizedPrice::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Path param: Localized Price Id
     * @param array{
     *   productID: string, amount?: int|null
     * }|LocalizedPriceUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LocalizedPriceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $productID = $parsed['productID'];
        unset($parsed['productID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['products/%1$s/localized-prices/%2$s', $productID, $id],
            body: (object) array_diff_key($parsed, array_flip(['productID'])),
            options: $options,
            convert: LocalizedPrice::class,
        );
    }

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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['products/%1$s/localized-prices', $productID],
            options: $requestOptions,
            convert: ListLocalizedPricesResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param array{productID: string}|LocalizedPriceArchiveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LocalizedPriceArchiveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $productID = $parsed['productID'];
        unset($parsed['productID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['products/%1$s/localized-prices/%2$s', $productID, $id],
            options: $options,
            convert: null,
        );
    }
}
