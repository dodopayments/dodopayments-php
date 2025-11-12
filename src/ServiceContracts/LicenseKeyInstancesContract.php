<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;

interface LicenseKeyInstancesContract
{
    /**
     * @api
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
     * @param array<mixed>|LicenseKeyInstanceUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param array<mixed>|LicenseKeyInstanceListParams $params
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;
}
