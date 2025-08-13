<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Client;
use Dodopayments\Contracts\LicenseKeysContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\LicenseKeys\LicenseKeyListResponseItem;

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
     *
     * @return list<LicenseKeyListResponseItem>
     */
    public function list(
        array|LicenseKeyListParams $params,
        ?RequestOptions $requestOptions = null
    ): array {
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
        return Conversion::coerce(
            new ListOf(LicenseKeyListResponseItem::class),
            value: $resp
        );
    }
}
