<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandCreateParams;
use Dodopayments\Brands\BrandUpdateParams;
use Dodopayments\Client;
use Dodopayments\Contracts\BrandsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Brands\BrandListResponse;
use Dodopayments\Responses\Brands\BrandUpdateImagesResponse;

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
        $args = Util::array_filter_omit(
            [
                'description' => $description,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
                'url' => $url,
            ],
        );
        [$parsed, $options] = BrandCreateParams::parseRequest(
            $args,
            $requestOptions
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
        $args = Util::array_filter_omit(
            [
                'imageID' => $imageID,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
            ],
        );
        [$parsed, $options] = BrandUpdateParams::parseRequest(
            $args,
            $requestOptions
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
