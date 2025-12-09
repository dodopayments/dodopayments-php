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
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AddonsContract;

final class AddonsService implements AddonsContract
{
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
     *   tax_category: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory,
     *   description?: string|null,
     * }|AddonCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|AddonCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AddonResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'addons',
            body: (object) $parsed,
            options: $options,
            convert: AddonResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        /** @var BaseResponse<AddonResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['addons/%1$s', $id],
            options: $requestOptions,
            convert: AddonResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   currency?: value-of<Currency>,
     *   description?: string|null,
     *   image_id?: string|null,
     *   name?: string|null,
     *   price?: int|null,
     *   tax_category?: 'digital_products'|'saas'|'e_book'|'edtech'|TaxCategory|null,
     * }|AddonUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AddonUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse {
        [$parsed, $options] = AddonUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AddonResponse> */
        $response = $this->client->request(
            method: 'patch',
            path: ['addons/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: AddonResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{page_number?: int, page_size?: int}|AddonListParams $params
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AddonListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = AddonListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<AddonResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'addons',
            query: $parsed,
            options: $options,
            convert: AddonResponse::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse {
        /** @var BaseResponse<AddonUpdateImagesResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['addons/%1$s/images', $id],
            options: $requestOptions,
            convert: AddonUpdateImagesResponse::class,
        );

        return $response->parse();
    }
}
