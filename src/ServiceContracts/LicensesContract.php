<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

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
     */
    public function activate(
        $licenseKey,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @api
     *
     * @param string $licenseKey
     * @param string $licenseKeyInstanceID
     */
    public function deactivate(
        $licenseKey,
        $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $licenseKey
     * @param string|null $licenseKeyInstanceID
     *
     * @return LicenseValidateResponse<HasRawResponse>
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = omit,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;
}
