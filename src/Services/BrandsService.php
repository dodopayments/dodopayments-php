<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Brands\Brand;
use Dodopayments\Brands\BrandArchiveResponse;
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
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
        RequestOptions|array|null $requestOptions = null,
    ): Brand {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'imageID' => $imageID,
                'name' => $name,
                'statementDescriptor' => $statementDescriptor,
                'supportEmail' => $supportEmail,
                'url' => $url,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param bool $includeArchived Set to true to also list archived brands. Default false.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?bool $includeArchived = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandListResponse {
        $params = Util::removeNulls(['includeArchived' => $includeArchived]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a brand. Its products, live subscriptions, and product collections
     * move to the `move_products_to` brand. Archive is permanent.
     *
     * @param string $id Brand Id
     * @param string|null $moveProductsTo Brand that takes over the products and the live subscriptions of the
     * brand you archive. It must be a brand of the same business, and it must
     * not be archived. The primary brand (its brand id is the business id) is
     * a valid target. Omit this field only when the brand holds no products
     * and no live subscriptions.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        ?string $moveProductsTo = null,
        RequestOptions|array|null $requestOptions = null,
    ): BrandArchiveResponse {
        $params = Util::removeNulls(['moveProductsTo' => $moveProductsTo]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, params: $params, requestOptions: $requestOptions);

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
