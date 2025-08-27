<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\BrandsContract;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class BrandsService implements BrandsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param string|null $description
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
     * @param string|null $url
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
     * Thin handler just calls `get_brand` and wraps in `Json(...)`.
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
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param string|null $name
     * @param string|null $statementDescriptor
     * @param string|null $supportEmail
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
