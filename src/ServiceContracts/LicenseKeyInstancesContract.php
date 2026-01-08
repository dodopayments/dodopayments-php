<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicenseKeyInstancesContract
{
    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string|null $licenseKeyID Filter by license key ID
     * @param int|null $pageNumber Page number default is 0
     * @param int|null $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function list(
        ?string $licenseKeyID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
