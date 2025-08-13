<?php

declare(strict_types=1);

namespace DodopaymentsClient\LicenseKeys;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\LicenseKeysContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\LicenseKeys\LicenseKeyListParams\Status;
use DodopaymentsClient\RequestOptions;

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
