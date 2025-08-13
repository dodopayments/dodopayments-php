<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\Addons\AddonCreateParams;
use DodoPayments\Addons\AddonListParams;
use DodoPayments\Addons\AddonResponse;
use DodoPayments\Addons\AddonUpdateParams;
use DodoPayments\Misc\Currency;
use DodoPayments\Misc\TaxCategory;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Addons\AddonUpdateImagesResponse;

interface AddonsContract
{
    /**
     * @param AddonCreateParams|array{
     *   currency: Currency::*,
     *   name: string,
     *   price: int,
     *   taxCategory: TaxCategory::*,
     *   description?: null|string,
     * } $params
     */
    public function create(
        AddonCreateParams|array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @param AddonUpdateParams|array{
     *   currency?: Currency::*,
     *   description?: null|string,
     *   imageID?: null|string,
     *   name?: null|string,
     *   price?: null|int,
     *   taxCategory?: TaxCategory::*,
     * } $params
     */
    public function update(
        string $id,
        AddonUpdateParams|array $params,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    /**
     * @param AddonListParams|array{pageNumber?: int, pageSize?: int} $params
     */
    public function list(
        AddonListParams|array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse;
}
