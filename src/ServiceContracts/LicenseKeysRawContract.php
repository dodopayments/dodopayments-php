<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
use Dodopayments\LicenseKeys\LicenseKeyUpdateParams;
use Dodopayments\RequestOptions;

interface LicenseKeysRawContract
{
    /**
     * @api
     *
     * @param string $id License key ID
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id License key ID
     * @param array<mixed>|LicenseKeyUpdateParams $params
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|LicenseKeyListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<LicenseKey>>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
