<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams;
use Dodopayments\Products\ProductCreateParams\CreditEntitlement;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Products\ProductListParams;
use Dodopayments\Products\ProductListResponse;
use Dodopayments\Products\ProductUpdateFilesParams;
use Dodopayments\Products\ProductUpdateFilesResponse;
use Dodopayments\Products\ProductUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductsRawContract;

/**
 * @phpstan-import-type CreditEntitlementShape from \Dodopayments\Products\ProductCreateParams\CreditEntitlement
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\ProductCreateParams\DigitalProductDelivery
 * @phpstan-import-type CreditEntitlementShape from \Dodopayments\Products\ProductUpdateParams\CreditEntitlement as CreditEntitlementShape1
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDeliveryShape1
 * @phpstan-import-type PriceShape from \Dodopayments\Products\Price
 * @phpstan-import-type LicenseKeyDurationShape from \Dodopayments\Products\LicenseKeyDuration
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ProductsRawService implements ProductsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   name: string,
     *   price: PriceShape,
     *   taxCategory: TaxCategory|value-of<TaxCategory>,
     *   addons?: list<string>|null,
     *   brandID?: string|null,
     *   creditEntitlements?: list<CreditEntitlement|CreditEntitlementShape>|null,
     *   description?: string|null,
     *   digitalProductDelivery?: DigitalProductDelivery|DigitalProductDeliveryShape|null,
     *   licenseKeyActivationMessage?: string|null,
     *   licenseKeyActivationsLimit?: int|null,
     *   licenseKeyDuration?: LicenseKeyDuration|LicenseKeyDurationShape|null,
     *   licenseKeyEnabled?: bool|null,
     *   metadata?: array<string,string>,
     * }|ProductCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function create(
        array|ProductCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'products',
            body: (object) $parsed,
            options: $options,
            convert: Product::class,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Product>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['products/%1$s', $id],
            options: $requestOptions,
            convert: Product::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   addons?: list<string>|null,
     *   brandID?: string|null,
     *   creditEntitlements?: list<ProductUpdateParams\CreditEntitlement|CreditEntitlementShape1>|null,
     *   description?: string|null,
     *   digitalProductDelivery?: ProductUpdateParams\DigitalProductDelivery|DigitalProductDeliveryShape1|null,
     *   imageID?: string|null,
     *   licenseKeyActivationMessage?: string|null,
     *   licenseKeyActivationsLimit?: int|null,
     *   licenseKeyDuration?: LicenseKeyDuration|LicenseKeyDurationShape|null,
     *   licenseKeyEnabled?: bool|null,
     *   metadata?: array<string,string>|null,
     *   name?: string|null,
     *   price?: PriceShape|null,
     *   taxCategory?: TaxCategory|value-of<TaxCategory>|null,
     * }|ProductUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['products/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   archived?: bool,
     *   brandID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   recurring?: bool,
     * }|ProductListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ProductListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ProductListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'products',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: ProductListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['products/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['products/%1$s/unarchive', $id],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param string $id Product Id
     * @param array{fileName: string}|ProductUpdateFilesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProductUpdateFilesResponse>
     *
     * @throws APIException
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProductUpdateFilesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['products/%1$s/files', $id],
            body: (object) $parsed,
            options: $options,
            convert: ProductUpdateFilesResponse::class,
        );
    }
}
