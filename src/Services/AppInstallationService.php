<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\AppInstallation\AppInstallationGetSettingsResponse;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AppInstallationContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class AppInstallationService implements AppInstallationContract
{
    /**
     * @api
     */
    public AppInstallationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AppInstallationRawService($client);
    }

    /**
     * @api
     *
     * The settings of the App Installation of the app token, with the secret values. The token
     * grant gives the installation. The token needs `app_settings:read`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSettings(
        RequestOptions|array|null $requestOptions = null
    ): AppInstallationGetSettingsResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveSettings(requestOptions: $requestOptions);

        return $response->parse();
    }
}
