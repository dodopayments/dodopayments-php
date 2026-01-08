<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\ShortLinks\ShortLinkListResponse;
use Dodopayments\Products\ShortLinks\ShortLinkNewResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ShortLinksContract
{
    /**
     * @api
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
    ): ShortLinkNewResponse;

    /**
     * @api
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
    ): DefaultPageNumberPagination;
}
