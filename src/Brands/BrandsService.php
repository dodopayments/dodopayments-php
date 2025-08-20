<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Client;
use Dodopayments\Contracts\BrandsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Brands\BrandListResponse;
use Dodopayments\Responses\Brands\BrandUpdateImagesResponse;

final class BrandsService implements BrandsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param null|string $description
     * @param null|string $name
     * @param null|string $statementDescriptor
     * @param null|string $supportEmail
     * @param null|string $url
     */
    public function create(
        $description = null,
        $name = null,
        $statementDescriptor = null,
        $supportEmail = null,
        $url = null,
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
        $resp = $this->client->request(
            method: 'post',
            path: 'brands',
            body: (object) $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Brand::class, value: $resp);
    }

    /**
     * Thin handler just calls `get_brand` and wraps in `Json(...)`.
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Brand {
        $resp = $this->client->request(
            method: 'get',
            path: ['brands/%1$s', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Brand::class, value: $resp);
    }

    /**
     * @param null|string $imageID The UUID you got back from the presigned‐upload call
     * @param null|string $name
     * @param null|string $statementDescriptor
     * @param null|string $supportEmail
     */
    public function update(
        string $id,
        $imageID = null,
        $name = null,
        $statementDescriptor = null,
        $supportEmail = null,
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
        $resp = $this->client->request(
            method: 'patch',
            path: ['brands/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Brand::class, value: $resp);
    }

    public function list(
        ?RequestOptions $requestOptions = null
    ): BrandListResponse {
        $resp = $this->client->request(
            method: 'get',
            path: 'brands',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BrandListResponse::class, value: $resp);
    }

    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BrandUpdateImagesResponse {
        $resp = $this->client->request(
            method: 'put',
            path: ['brands/%1$s/images', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(BrandUpdateImagesResponse::class, value: $resp);
    }
}
