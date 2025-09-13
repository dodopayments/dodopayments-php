<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

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
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $currency,
        $name,
        $price,
        $taxCategory,
        $description = omit,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @param Currency|value-of<Currency>|null $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the Addon
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $currency = omit,
        $description = omit,
        $imageID = omit,
        $name = omit,
        $price = omit,
        $taxCategory = omit,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return AddonResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @return AddonUpdateImagesResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse;

    /**
     * @api
     *
     * @return AddonUpdateImagesResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateImagesRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse;
}
