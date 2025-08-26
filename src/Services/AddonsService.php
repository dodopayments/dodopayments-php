<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Client;
use Dodopayments\Contracts\AddonsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Addons\AddonUpdateImagesResponse;

use const Dodopayments\Core\OMIT as omit;

final class AddonsService implements AddonsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param Currency::* $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory::* $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     */
    public function create(
        $currency,
        $name,
        $price,
        $taxCategory,
        $description = omit,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse {
        [$parsed, $options] = AddonCreateParams::parseRequest(
            [
                'currency' => $currency,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
                'description' => $description,
            ],
            $requestOptions,
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
     * @param Currency::* $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory::* $taxCategory tax category of the Addon
     */
    public function update(
        string $id,
        $currency = omit,
        $description = omit,
        $imageID = omit,
        $name = omit,
        $price = omit,
        $taxCategory = omit,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse {
        [$parsed, $options] = AddonUpdateParams::parseRequest(
            [
                'currency' => $currency,
                'description' => $description,
                'imageID' => $imageID,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
            ],
            $requestOptions,
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
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonListParams::parseRequest(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize],
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
