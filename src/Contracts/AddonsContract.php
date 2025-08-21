<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Addons\AddonResponse;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Addons\AddonUpdateImagesResponse;

interface AddonsContract
{
    /**
     * @param Currency::* $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory::* $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     */
    public function create(
        $currency,
        $name,
        $price,
        $taxCategory,
        $description = null,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @param Currency::* $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory::* $taxCategory tax category of the Addon
     */
    public function update(
        string $id,
        $currency = null,
        $description = null,
        $imageID = null,
        $name = null,
        $price = null,
        $taxCategory = null,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    /**
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse;
}
