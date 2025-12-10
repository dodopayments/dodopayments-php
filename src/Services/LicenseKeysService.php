<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicenseKeysContract;

final class LicenseKeysService implements LicenseKeysContract
{
    /**
     * @api
     */
    public LicenseKeysRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LicenseKeysRawService($client);
    }

    /**
     * @api
     *
     * @param string $id License key ID
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKey {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id License key ID
     * @param int|null $activationsLimit The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     * @param bool|null $disabled Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     * @param string|\DateTimeInterface|null $expiresAt The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?int $activationsLimit = null,
        ?bool $disabled = null,
        string|\DateTimeInterface|null $expiresAt = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey {
        $params = [
            'activationsLimit' => $activationsLimit,
            'disabled' => $disabled,
            'expiresAt' => $expiresAt,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param 'active'|'expired'|'disabled'|Status $status Filter by license key status
     *
     * @return DefaultPageNumberPagination<LicenseKey>
     *
     * @throws APIException
     */
    public function list(
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        string|Status|null $status = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'customerID' => $customerID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'productID' => $productID,
            'status' => $status,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
