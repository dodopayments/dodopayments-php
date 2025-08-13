<?php

declare(strict_types=1);

namespace DodoPayments\LicenseKeys;

use DodoPayments\Client;
use DodoPayments\Contracts\LicenseKeysContract;
use DodoPayments\Core\Conversion;
use DodoPayments\LicenseKeys\LicenseKeyListParams\Status;
use DodoPayments\RequestOptions;

final class LicenseKeysService implements LicenseKeysContract
{
    public function __construct(private Client $client) {}

    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKey {
        $resp = $this->client->request(
            method: 'get',
            path: ['license_keys/%1$s', $id],
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKey::class, value: $resp);
    }

    /**
     * @param array{
     *   activationsLimit?: null|int,
     *   disabled?: null|bool,
     *   expiresAt?: null|\DateTimeInterface,
     * }|LicenseKeyUpdateParams $params
     */
    public function update(
        string $id,
        array|LicenseKeyUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey {
        [$parsed, $options] = LicenseKeyUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['license_keys/%1$s', $id],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKey::class, value: $resp);
    }

    /**
     * @param array{
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   productID?: string,
     *   status?: Status::*,
     * }|LicenseKeyListParams $params
     */
    public function list(
        array|LicenseKeyListParams $params,
        ?RequestOptions $requestOptions = null
    ): LicenseKey {
        [$parsed, $options] = LicenseKeyListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'license_keys',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKey::class, value: $resp);
    }
}
