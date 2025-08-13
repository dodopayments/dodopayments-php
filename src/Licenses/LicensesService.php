<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Client;
use Dodopayments\Contracts\LicensesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Licenses\LicenseValidateResponse;

final class LicensesService implements LicensesContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{licenseKey: string, name: string}|LicenseActivateParams $params
     */
    public function activate(
        array|LicenseActivateParams $params,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'licenses/activate',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseKeyInstance::class, value: $resp);
    }

    /**
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID: string
     * }|LicenseDeactivateParams $params
     */
    public function deactivate(
        array|LicenseDeactivateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            $params,
            $requestOptions
        );

        return $this->client->request(
            method: 'post',
            path: 'licenses/deactivate',
            body: (object) $parsed,
            options: $options,
        );
    }

    /**
     * @param array{
     *   licenseKey: string, licenseKeyInstanceID?: null|string
     * }|LicenseValidateParams $params
     */
    public function validate(
        array|LicenseValidateParams $params,
        ?RequestOptions $requestOptions = null
    ): LicenseValidateResponse {
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'licenses/validate',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(LicenseValidateResponse::class, value: $resp);
    }
}
