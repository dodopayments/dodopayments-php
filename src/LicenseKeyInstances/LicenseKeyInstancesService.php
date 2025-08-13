<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeyInstances;

use Dodopayments\Client;
use Dodopayments\Contracts\LicenseKeyInstancesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\LicenseKeyInstances\LicenseKeyInstanceListResponseItem;

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
     * @param array{name: string}|LicenseKeyInstanceUpdateParams $params
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance {
        [$parsed, $options] = LicenseKeyInstanceUpdateParams::parseRequest(
            $params,
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
     * @param array{
     *   licenseKeyID?: null|string, pageNumber?: null|int, pageSize?: null|int
     * }|LicenseKeyInstanceListParams $params
     *
     * @return list<LicenseKeyInstanceListResponseItem>
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): array {
        [$parsed, $options] = LicenseKeyInstanceListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'license_key_instances',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            new ListOf(LicenseKeyInstanceListResponseItem::class),
            value: $resp
        );
    }
}
