<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface AddonsContract
{
    /**
     * @api
     *
     * @param Currency|value-of<Currency> $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $taxCategory,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse;

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param Currency|value-of<Currency>|null $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?int $price = null,
        TaxCategory|string|null $taxCategory = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse;

    /**
     * @api
     *
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AddonUpdateImagesResponse;
}
