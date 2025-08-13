<?php

declare(strict_types=1);

namespace DodoPayments\Addons;

use DodoPayments\Client;
use DodoPayments\Contracts\AddonsContract;
use DodoPayments\Core\Conversion;
use DodoPayments\Misc\Currency;
use DodoPayments\Misc\TaxCategory;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Addons\AddonUpdateImagesResponse;

final class AddonsService implements AddonsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param AddonCreateParams|array{
     *   currency: Currency::*,
     *   name: string,
     *   price: int,
     *   taxCategory: TaxCategory::*,
     *   description?: null|string,
     * } $params
     */
    public function create(
        AddonCreateParams|array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'addons',
            body: (object) $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AddonResponse::class, value: $resp);
    }

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['addons/%1$s', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AddonResponse::class, value: $resp);
    }

    /**
     * @param AddonUpdateParams|array{
     *   currency?: Currency::*,
     *   description?: null|string,
     *   imageID?: null|string,
     *   name?: null|string,
     *   price?: null|int,
     *   taxCategory?: TaxCategory::*,
     * } $params
     */
    public function update(
        string $id,
        AddonUpdateParams|array $params,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse {
        [$parsed, $options] = AddonUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['addons/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AddonResponse::class, value: $resp);
    }

    /**
     * @param AddonListParams|array{pageNumber?: int, pageSize?: int} $params
     */
    public function list(
        AddonListParams|array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'addons',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AddonResponse::class, value: $resp);
    }

    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse {
        $resp = $this->client->request(
            method: 'put',
            path: ['addons/%1$s/images', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AddonUpdateImagesResponse::class, value: $resp);
    }
}
