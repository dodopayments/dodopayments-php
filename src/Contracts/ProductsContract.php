<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Misc\TaxCategory;
use Dodopayments\Products\LicenseKeyDuration;
use Dodopayments\Products\Price\OneTimePrice;
use Dodopayments\Products\Price\RecurringPrice;
use Dodopayments\Products\Product;
use Dodopayments\Products\ProductCreateParams;
use Dodopayments\Products\ProductCreateParams\DigitalProductDelivery;
use Dodopayments\Products\ProductListParams;
use Dodopayments\Products\ProductUpdateFilesParams;
use Dodopayments\Products\ProductUpdateParams;
use Dodopayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDelivery1;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\ProductListResponse;
use Dodopayments\Responses\Products\ProductUpdateFilesResponse;

interface ProductsContract
{
    /**
     * @param array{
     *   price: OneTimePrice|RecurringPrice,
     *   taxCategory: TaxCategory::*,
     *   addons?: null|list<string>,
     *   brandID?: null|string,
     *   description?: null|string,
     *   digitalProductDelivery?: null|DigitalProductDelivery,
     *   licenseKeyActivationMessage?: null|string,
     *   licenseKeyActivationsLimit?: null|int,
     *   licenseKeyDuration?: LicenseKeyDuration,
     *   licenseKeyEnabled?: null|bool,
     *   metadata?: array<string, string>,
     *   name?: null|string,
     * }|ProductCreateParams $params
     */
    public function create(
        array|ProductCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Product;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): Product;

    /**
     * @param array{
     *   addons?: null|list<string>,
     *   brandID?: null|string,
     *   description?: null|string,
     *   digitalProductDelivery?: null|DigitalProductDelivery1,
     *   imageID?: null|string,
     *   licenseKeyActivationMessage?: null|string,
     *   licenseKeyActivationsLimit?: null|int,
     *   licenseKeyDuration?: LicenseKeyDuration,
     *   licenseKeyEnabled?: null|bool,
     *   metadata?: null|array<string, string>,
     *   name?: null|string,
     *   price?: OneTimePrice|RecurringPrice,
     *   taxCategory?: TaxCategory::*,
     * }|ProductUpdateParams $params
     */
    public function update(
        string $id,
        array|ProductUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param array{
     *   archived?: bool,
     *   brandID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   recurring?: bool,
     * }|ProductListParams $params
     */
    public function list(
        array|ProductListParams $params,
        ?RequestOptions $requestOptions = null
    ): ProductListResponse;

    public function delete(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    public function unarchive(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @param array{fileName: string}|ProductUpdateFilesParams $params
     */
    public function updateFiles(
        string $id,
        array|ProductUpdateFilesParams $params,
        ?RequestOptions $requestOptions = null,
    ): ProductUpdateFilesResponse;
}
