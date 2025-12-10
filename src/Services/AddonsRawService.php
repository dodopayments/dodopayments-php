<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AddonsRawContract;

final class AddonsRawService implements AddonsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   currency: value-of<Currency>,
     *   name: string,
     *   price: int,
     *   taxCategory: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory,
     *   description?: string|null,
     * }|AddonCreateParams $params
     *
     * @return BaseResponse<AddonResponse>
     *
     * @throws APIException
     */
    public function create(
        array|AddonCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = AddonCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'addons',
            body: (object) $parsed,
            options: $options,
            convert: AddonResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     *
     * @return BaseResponse<AddonResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['addons/%1$s', $id],
            options: $requestOptions,
            convert: AddonResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param array{
     *   currency?: value-of<Currency>,
     *   description?: string|null,
     *   imageID?: string|null,
     *   name?: string|null,
     *   price?: int|null,
     *   taxCategory?: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory|null,
     * }|AddonUpdateParams $params
     *
     * @return BaseResponse<AddonResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AddonUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AddonUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['addons/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: AddonResponse::class,
        );
    }

    /**
     * @api
     *
     * @param array{pageNumber?: int, pageSize?: int}|AddonListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<AddonResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|AddonListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = AddonListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'addons',
            query: Util::array_transform_keys(
                $parsed,
                ['pageNumber' => 'page_number', 'pageSize' => 'page_size']
            ),
            options: $options,
            convert: AddonResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     *
     * @return BaseResponse<AddonUpdateImagesResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['addons/%1$s/images', $id],
            options: $requestOptions,
            convert: AddonUpdateImagesResponse::class,
        );
    }
}
