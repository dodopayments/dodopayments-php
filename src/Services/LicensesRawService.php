<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicensesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LicensesRawService implements LicensesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{licenseKey: string, name: string}|LicenseActivateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseActivateResponse>
     *
     * @throws APIException
     */
    public function activate(
        array|LicenseActivateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'licenses/activate',
            body: (object) $parsed,
            options: $options,
            convert: LicenseActivateResponse::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID: string
     * }|LicenseDeactivateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'licenses/deactivate',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID?: string|null
     * }|LicenseValidateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseValidateResponse>
     *
     * @throws APIException
     */
    public function validate(
        array|LicenseValidateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'licenses/validate',
            body: (object) $parsed,
            options: $options,
            convert: LicenseValidateResponse::class,
        );
    }
}
