<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\LicensesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Licenses\LicenseValidateResponse;

use const Dodopayments\Core\OMIT as omit;

final class LicensesService implements LicensesContract
{
    public function __construct(private Client $client) {}

    /**
     * @param string $licenseKey
     * @param string $name
     */
    public function activate(
        $licenseKey,
        $name,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            ['licenseKey' => $licenseKey, 'name' => $name],
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
     * @param string $licenseKey
     * @param string $licenseKeyInstanceID
     */
    public function deactivate(
        $licenseKey,
        $licenseKeyInstanceID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            [
                'licenseKey' => $licenseKey,
                'licenseKeyInstanceID' => $licenseKeyInstanceID,
            ],
            $requestOptions,
        );

        return $this->client->request(
            method: 'post',
            path: 'licenses/deactivate',
            body: (object) $parsed,
            options: $options,
        );
    }

    /**
     * @param string $licenseKey
     * @param string|null $licenseKeyInstanceID
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = omit,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse {
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            [
                'licenseKey' => $licenseKey,
                'licenseKeyInstanceID' => $licenseKeyInstanceID,
            ],
            $requestOptions,
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
