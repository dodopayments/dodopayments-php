<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\LicenseKeyInstances\LicenseKeyInstanceListResponseItem;

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
     *
     * @return list<LicenseKeyInstanceListResponseItem>
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array;
}
