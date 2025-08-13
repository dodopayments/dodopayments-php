<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Addons\AddonUpdateImagesResponse;

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
