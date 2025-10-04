<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateResponse;
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
     * @throws APIException
     */
    public function activate(
        $licenseKey,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseActivateResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function activateRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LicenseActivateResponse;

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
     * @throws APIException
     */
    public function validateRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): LicenseValidateResponse;
}
