<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Client;
use Dodopayments\Contracts\LicenseKeysContract;
use Dodopayments\Core\Conversion;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;

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
     * @param null|int $activationsLimit The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     * @param null|bool $disabled Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     * @param null|\DateTimeInterface $expiresAt The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    public function update(
        string $id,
        $activationsLimit = null,
        $disabled = null,
        $expiresAt = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey {
        [$parsed, $options] = LicenseKeyUpdateParams::parseRequest(
            [
                'activationsLimit' => $activationsLimit,
                'disabled' => $disabled,
                'expiresAt' => $expiresAt,
            ],
            $requestOptions,
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
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param Status::* $status Filter by license key status
     */
    public function list(
        $customerID = null,
        $pageNumber = null,
        $pageSize = null,
        $productID = null,
        $status = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey {
        [$parsed, $options] = LicenseKeyListParams::parseRequest(
            [
                'customerID' => $customerID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'productID' => $productID,
                'status' => $status,
            ],
            $requestOptions,
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
