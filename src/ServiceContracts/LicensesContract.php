<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface LicensesContract
{
    /**
     * @api
     *
     * @param string $licenseKey
     * @param string $name
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function activate(
        $licenseKey,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return LicenseKeyInstance<HasRawResponse>
     *
     * @throws APIException
     */
    public function activateRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string $licenseKey
     * @param string $licenseKeyInstanceID
     *
     * @throws APIException
     */
    public function deactivate(
        $licenseKey,
        $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deactivateRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $licenseKey
     * @param string|null $licenseKeyInstanceID
     *
     * @return LicenseValidateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = omit,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return LicenseValidateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function validateRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LicenseValidateResponse;
}
