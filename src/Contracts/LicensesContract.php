<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Licenses\LicenseValidateResponse;

interface LicensesContract
{
    /**
     * @param string $licenseKey
     * @param string $name
     */
    public function activate(
        $licenseKey,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance;

    /**
     * @param string $licenseKey
     * @param string $licenseKeyInstanceID
     */
    public function deactivate(
        $licenseKey,
        $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @param string $licenseKey
     * @param string|null $licenseKeyInstanceID
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;
}
