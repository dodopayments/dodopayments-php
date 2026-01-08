<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicenseKeysContract
{
    /**
     * @api
     *
     * @param string $id License key ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): LicenseKey;

    /**
     * @api
     *
     * @param string $id License key ID
     * @param int|null $activationsLimit The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     * @param bool|null $disabled Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     * @param \DateTimeInterface|null $expiresAt The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?int $activationsLimit = null,
        ?bool $disabled = null,
        ?\DateTimeInterface $expiresAt = null,
        RequestOptions|array|null $requestOptions = null,
    ): LicenseKey;

    /**
     * @api
     *
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param Status|value-of<Status> $status Filter by license key status
     * @param RequestOpts|null $requestOptions
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
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;
}
