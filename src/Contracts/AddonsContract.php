<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\Addons\AddonCreateParams;
use DodopaymentsClient\Addons\AddonListParams;
use DodopaymentsClient\Addons\AddonResponse;
use DodopaymentsClient\Addons\AddonUpdateParams;
use DodopaymentsClient\Misc\Currency;
use DodopaymentsClient\Misc\TaxCategory;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Addons\AddonUpdateImagesResponse;

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
