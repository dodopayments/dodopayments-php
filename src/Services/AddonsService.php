<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AddonsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class AddonsService implements AddonsContract
{
    /**
     * @api
     */
    public AddonsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AddonsRawService($client);
    }

    /**
     * @api
     *
     * @param Currency|value-of<Currency> $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $taxCategory,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
                'description' => $description,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AddonResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param Currency|value-of<Currency>|null $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?int $price = null,
        TaxCategory|string|null $taxCategory = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'description' => $description,
                'imageID' => $imageID,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AddonUpdateImagesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateImages($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
