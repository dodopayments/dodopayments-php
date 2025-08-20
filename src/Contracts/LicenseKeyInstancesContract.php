<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;

interface LicenseKeyInstancesContract
{
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @param string $name
     */
    public function update(
        string $id,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @param null|string $licenseKeyID Filter by license key ID
     * @param null|int $pageNumber Page number default is 0
     * @param null|int $pageSize Page size default is 10 max is 100
     */
    public function list(
        $licenseKeyID = null,
        $pageNumber = null,
        $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance;
}
