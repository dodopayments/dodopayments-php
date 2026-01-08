<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseValidateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicensesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LicensesService implements LicensesContract
{
    /**
     * @api
     */
    public LicensesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LicensesRawService($client);
    }

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
    ): LicenseActivateResponse {
        $params = Util::removeNulls(['licenseKey' => $licenseKey, 'name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->activate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): mixed {
        $params = Util::removeNulls(
            [
                'licenseKey' => $licenseKey,
                'licenseKeyInstanceID' => $licenseKeyInstanceID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->deactivate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): LicenseValidateResponse {
        $params = Util::removeNulls(
            [
                'licenseKey' => $licenseKey,
                'licenseKeyInstanceID' => $licenseKeyInstanceID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->validate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
