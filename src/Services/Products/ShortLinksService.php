<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\ShortLinks\ShortLinkListResponse;
use Dodopayments\Products\ShortLinks\ShortLinkNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\ShortLinksContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ShortLinksService implements ShortLinksContract
{
    /**
     * @api
     */
    public ShortLinksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ShortLinksRawService($client);
    }

    /**
     * @api
     *
     * Gives a Short Checkout URL with custom slug for a product.
     * Uses a Static Checkout URL under the hood.
     *
     * @param string $id Product Id
     * @param string $slug slug for the short link
     * @param array<string,string>|null $staticCheckoutParams static Checkout URL parameters to apply to the resulting
     * short URL
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $slug,
        ?array $staticCheckoutParams = null,
        RequestOptions|array|null $requestOptions = null,
    ): ShortLinkNewResponse {
        $params = Util::removeNulls(
            ['slug' => $slug, 'staticCheckoutParams' => $staticCheckoutParams]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists all short links created by the business.
     *
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<ShortLinkListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'productID' => $productID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
