<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicenseKeyInstancesContract;

use const Dodopayments\Core\OMIT as omit;

final class LicenseKeyInstancesService implements LicenseKeyInstancesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['license_key_instances/%1$s', $id],
            options: $requestOptions,
            convert: LicenseKeyInstance::class,
        );
    }

    /**
     * @api
     *
     * @param string $name
     */
    public function update(
        string $id,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        [$parsed, $options] = LicenseKeyInstanceUpdateParams::parseRequest(
            ['name' => $name],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['license_key_instances/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: LicenseKeyInstance::class,
        );
    }

    /**
     * @api
     *
     * @param string|null $licenseKeyID Filter by license key ID
     * @param int|null $pageNumber Page number default is 0
     * @param int|null $pageSize Page size default is 10 max is 100
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     */
    public function list(
        $licenseKeyID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = LicenseKeyInstanceListParams::parseRequest(
            [
                'licenseKeyID' => $licenseKeyID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'license_key_instances',
            query: $parsed,
            options: $options,
            convert: LicenseKeyInstance::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
