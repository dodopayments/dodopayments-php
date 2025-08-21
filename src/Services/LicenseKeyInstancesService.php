<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\LicenseKeyInstancesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;

final class LicenseKeyInstancesService implements LicenseKeyInstancesContract
{
    public function __construct(private Client $client) {}

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        $resp = $this->client->request(
            method: 'get',
            path: ['license_key_instances/%1$s', $id],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKeyInstance::class, value: $resp);
    }

    /**
     * @param string $name
     */
    public function update(
        string $id,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        $args = ['name' => $name];
        [$parsed, $options] = LicenseKeyInstanceUpdateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['license_key_instances/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKeyInstance::class, value: $resp);
    }

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
    ): LicenseKeyInstance {
        $args = [
            'licenseKeyID' => $licenseKeyID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
        ];
        $args = Util::array_filter_null(
            $args,
            ['licenseKeyID', 'pageNumber', 'pageSize']
        );
        [$parsed, $options] = LicenseKeyInstanceListParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'license_key_instances',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKeyInstance::class, value: $resp);
    }
}
