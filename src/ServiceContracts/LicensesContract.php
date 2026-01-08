<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface LicensesContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function activate(
        string $licenseKey,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): LicenseActivateResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function deactivate(
        string $licenseKey,
        string $licenseKeyInstanceID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function validate(
        string $licenseKey,
        ?string $licenseKeyInstanceID = null,
        RequestOptions|array|null $requestOptions = null,
    ): LicenseValidateResponse;
}
