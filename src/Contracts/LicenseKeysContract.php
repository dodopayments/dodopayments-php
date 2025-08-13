<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\LicenseKeys\LicenseKeyUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\LicenseKeys\LicenseKeyListResponseItem;

interface LicenseKeysContract
{
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKey;

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
    ): LicenseKey;

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
        ?RequestOptions $requestOptions = null,
    ): array;
}
