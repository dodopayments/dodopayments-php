<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandListResponse;
use Dodopayments\Brands\BrandUpdateImagesResponse;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\BrandsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class BrandsService implements BrandsContract
{
    /**
     * @api
     */
    public BrandsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BrandsRawService($client);
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $description = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
                'url' => $url,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Thin handler just calls `get_brand` and wraps in `Json(...)`
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Brand {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param string|null $imageID The UUID you got back from the presigned‐upload call
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'imageID' => $imageID,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BrandListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Brand Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BrandUpdateImagesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateImages($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
