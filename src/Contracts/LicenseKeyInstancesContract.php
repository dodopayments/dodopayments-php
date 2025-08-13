<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\LicenseKeyInstances\LicenseKeyInstance;
use DodoPayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use DodoPayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use DodoPayments\RequestOptions;

interface LicenseKeyInstancesContract
{
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @param array{name: string}|LicenseKeyInstanceUpdateParams $params
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance;

    /**
     * @param array{
     *   licenseKeyID?: null|string, pageNumber?: null|int, pageSize?: null|int
     * }|LicenseKeyInstanceListParams $params
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance;
}
