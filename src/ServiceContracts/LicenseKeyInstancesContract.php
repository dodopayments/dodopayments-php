<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface LicenseKeyInstancesContract
{
    /**
     * @api
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string $name
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string|null $licenseKeyID Filter by license key ID
     * @param int|null $pageNumber Page number default is 0
     * @param int|null $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function list(
        $licenseKeyID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;
}
