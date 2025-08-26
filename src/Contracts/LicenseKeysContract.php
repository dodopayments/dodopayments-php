<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface LicenseKeysContract
{
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKey;

    /**
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
    ): LicenseKey;

    /**
     * @param string $customerID Filter by customer ID
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param string $productID Filter by product ID
     * @param Status::* $status Filter by license key status
     */
    public function list(
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $productID = omit,
        $status = omit,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey;
}
