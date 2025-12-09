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
use Dodopayments\ServiceContracts\LicensesContract;

final class LicensesService implements LicensesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{license_key: string, name: string}|LicenseActivateParams $params
     *
     * @throws APIException
     */
    public function activate(
        array|LicenseActivateParams $params,
        ?RequestOptions $requestOptions = null
    ): LicenseActivateResponse {
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<LicenseActivateResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'licenses/activate',
            body: (object) $parsed,
            options: $options,
            convert: LicenseActivateResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   license_key: string, license_key_instance_id: string
     * }|LicenseDeactivateParams $params
     *
     * @throws APIException
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'post',
            path: 'licenses/deactivate',
            body: (object) $parsed,
            options: $options,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   license_key: string, license_key_instance_id?: string|null
     * }|LicenseValidateParams $params
     *
     * @throws APIException
     */
    public function validate(
        array|LicenseValidateParams $params,
        ?RequestOptions $requestOptions = null
    ): LicenseValidateResponse {
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<LicenseValidateResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'licenses/validate',
            body: (object) $parsed,
            options: $options,
            convert: LicenseValidateResponse::class,
        );

        return $response->parse();
    }
}
