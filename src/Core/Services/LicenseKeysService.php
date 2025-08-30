<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\LicenseKeysContract;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\LicenseKeys\LicenseKeyUpdateParams;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class LicenseKeysService implements LicenseKeysContract
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
    ): LicenseKey {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['license_keys/%1$s', $id],
            options: $requestOptions,
            convert: LicenseKey::class,
        );
    }

    /**
     * @api
     *
     * @param int|null $activationsLimit The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     * @param bool|null $disabled Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     * @param \DateTimeInterface|null $expiresAt The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    public function update(
        string $id,
        $activationsLimit = omit,
        $disabled = omit,
        $expiresAt = omit,
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

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['license_keys/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: LicenseKey::class,
        );
    }

    /**
     * @api
     *
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param Status::* $status Filter by license key status
     *
     * @return DefaultPageNumberPagination<LicenseKey>
     */
    public function list(
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $productID = omit,
        $status = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
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

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'license_keys',
            query: $parsed,
            options: $options,
            convert: LicenseKey::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
