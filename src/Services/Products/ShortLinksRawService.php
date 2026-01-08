<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\ShortLinks\ShortLinkCreateParams;
use Dodopayments\Products\ShortLinks\ShortLinkListParams;
use Dodopayments\Products\ShortLinks\ShortLinkListResponse;
use Dodopayments\Products\ShortLinks\ShortLinkNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\ShortLinksRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ShortLinksRawService implements ShortLinksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Gives a Short Checkout URL with custom slug for a product.
     * Uses a Static Checkout URL under the hood.
     *
     * @param string $id Product Id
     * @param array{
     *   slug: string, staticCheckoutParams?: array<string,string>|null
     * }|ShortLinkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ShortLinkNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|ShortLinkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ShortLinkCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['products/%1$s/short_links', $id],
            body: (object) $parsed,
            options: $options,
            convert: ShortLinkNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Lists all short links created by the business.
     *
     * @param array{
     *   pageNumber?: int, pageSize?: int, productID?: string
     * }|ShortLinkListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ShortLinkListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ShortLinkListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ShortLinkListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'products/short_links',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'productID' => 'product_id',
                ],
            ),
            options: $options,
            convert: ShortLinkListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
