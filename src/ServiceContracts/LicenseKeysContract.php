<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;

interface LicenseKeysContract
{
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
    ): LicenseKey;

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
    ): LicenseKey;

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
    ): DefaultPageNumberPagination;
}
