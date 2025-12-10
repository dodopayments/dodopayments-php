<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;

interface LicensesContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function activate(
        string $licenseKey,
        string $name,
        ?RequestOptions $requestOptions = null
    ): LicenseActivateResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function deactivate(
        string $licenseKey,
        string $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @throws APIException
     */
    public function validate(
        string $licenseKey,
        ?string $licenseKeyInstanceID = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse;
}
