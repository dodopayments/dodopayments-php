<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\LicensesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\Licenses\LicenseActivateParams;
use Dodopayments\Licenses\LicenseDeactivateParams;
use Dodopayments\Licenses\LicenseValidateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Licenses\LicenseValidateResponse;

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
        $args = ['licenseKey' => $licenseKey, 'name' => $name];
        [$parsed, $options] = LicenseActivateParams::parseRequest(
            $args,
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
        $args = [
            'licenseKey' => $licenseKey,
            'licenseKeyInstanceID' => $licenseKeyInstanceID,
        ];
        [$parsed, $options] = LicenseDeactivateParams::parseRequest(
            $args,
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
     * @param string $licenseKey
     * @param null|string $licenseKeyInstanceID
     */
    public function validate(
        $licenseKey,
        $licenseKeyInstanceID = null,
        ?RequestOptions $requestOptions = null,
    ): LicenseValidateResponse {
        $args = [
            'licenseKey' => $licenseKey,
            'licenseKeyInstanceID' => $licenseKeyInstanceID,
        ];
        $args = Util::array_filter_null($args, ['licenseKeyInstanceID']);
        [$parsed, $options] = LicenseValidateParams::parseRequest(
            $args,
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
