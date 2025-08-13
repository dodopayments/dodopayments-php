<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Misc\TaxCategory;
use DodoPayments\Products\LicenseKeyDuration;
use DodoPayments\Products\Price\OneTimePrice;
use DodoPayments\Products\Price\RecurringPrice;
use DodoPayments\Products\Product;
use DodoPayments\Products\ProductCreateParams;
use DodoPayments\Products\ProductCreateParams\DigitalProductDelivery;
use DodoPayments\Products\ProductListParams;
use DodoPayments\Products\ProductUpdateFilesParams;
use DodoPayments\Products\ProductUpdateParams;
use DodoPayments\Products\ProductUpdateParams\DigitalProductDelivery as DigitalProductDelivery1;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Products\ProductListResponse;
use DodoPayments\Responses\Products\ProductUpdateFilesResponse;

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
