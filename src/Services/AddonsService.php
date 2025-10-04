<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AddonsContract;

use const Dodopayments\Core\OMIT as omit;

final class AddonsService implements AddonsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param Currency|value-of<Currency> $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     *
     * @throws APIException
     */
    public function create(
        $currency,
        $name,
        $price,
        $taxCategory,
        $description = omit,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse {
        $params = [
            'currency' => $currency,
            'name' => $name,
            'price' => $price,
            'taxCategory' => $taxCategory,
            'description' => $description,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        // @phpstan-ignore-next-line;
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
     * @param Currency|value-of<Currency>|null $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the Addon
     *
     * @throws APIException
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
        $params = [
            'currency' => $currency,
            'description' => $description,
            'imageID' => $imageID,
            'name' => $name,
            'price' => $price,
            'taxCategory' => $taxCategory,
        ];

        return $this->updateRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse {
        [$parsed, $options] = AddonUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        $params = ['pageNumber' => $pageNumber, 'pageSize' => $pageSize];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = AddonListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'addons',
            query: $parsed,
            options: $options,
            convert: AddonResponse::class,
            page: DefaultPageNumberPagination::class,
        );
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
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['addons/%1$s/images', $id],
            options: $requestOptions,
            convert: AddonUpdateImagesResponse::class,
        );
    }
}
