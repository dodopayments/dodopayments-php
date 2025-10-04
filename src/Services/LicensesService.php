<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicensesContract;

use const Dodopayments\Core\OMIT as omit;

final class LicensesService implements LicensesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
    ): LicenseActivateResponse {
        $params = ['licenseKey' => $licenseKey, 'name' => $name];

        return $this->activateRaw($params, $requestOptions);
    }

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
    ): LicenseActivateResponse {
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param string $licenseKey
     * @param string $licenseKeyInstanceID
     *
     * @throws APIException
     */
    public function deactivate(
        $licenseKey,
        $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = [
            'licenseKey' => $licenseKey,
            'licenseKeyInstanceID' => $licenseKeyInstanceID,
        ];

        return $this->deactivateRaw($params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @param string $licenseKey
     * @param string|null $licenseKeyInstanceID
     *
     * @throws APIException
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = omit,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse {
        $params = [
            'licenseKey' => $licenseKey,
            'licenseKeyInstanceID' => $licenseKeyInstanceID,
        ];

        return $this->validateRaw($params, $requestOptions);
    }

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
    ): LicenseValidateResponse {
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'licenses/validate',
            body: (object) $parsed,
            options: $options,
            convert: LicenseValidateResponse::class,
        );
    }
}
