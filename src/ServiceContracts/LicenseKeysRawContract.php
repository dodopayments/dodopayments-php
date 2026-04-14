<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyCreateParams;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
use Dodopayments\LicenseKeys\LicenseKeyUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicenseKeysRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|LicenseKeyCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function create(
        array|LicenseKeyCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param string $id License key ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param string $id License key ID
     * @param array<string,mixed>|LicenseKeyUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @deprecated
     *
     * @api
     *
     * @param array<string,mixed>|LicenseKeyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<LicenseKey>>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
