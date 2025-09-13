<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BrandsContract;

use const Dodopayments\Core\OMIT as omit;

final class BrandsService implements BrandsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string|null $description
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     * @param string|null $url
     *
     * @return Brand<HasRawResponse>
     */
    public function create(
        $description = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
        $url = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        [$parsed, $options] = BrandCreateParams::parseRequest(
            [
                'description' => $description,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
                'url' => $url,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * Thin handler just calls `get_brand` and wraps in `Json(...)`
     *
     * @return Brand<HasRawResponse>
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['brands/%1$s', $id],
            options: $requestOptions,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     *
     * @return Brand<HasRawResponse>
     */
    public function update(
        string $id,
        $imageID = omit,
        $name = omit,
        $statementDescriptor = omit,
        $supportEmail = omit,
        ?RequestOptions $requestOptions = null,
    ): Brand {
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            [
                'imageID' => $imageID,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['brands/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Brand::class,
        );
    }

    /**
     * @api
     *
     * @return BrandListResponse<HasRawResponse>
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'brands',
            options: $requestOptions,
            convert: BrandListResponse::class,
        );
    }

    /**
     * @api
     *
     * @return BrandUpdateImagesResponse<HasRawResponse>
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BrandUpdateImagesResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['brands/%1$s/images', $id],
            options: $requestOptions,
            convert: BrandUpdateImagesResponse::class,
        );
    }
}
