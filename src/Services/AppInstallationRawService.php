<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\AppInstallation\AppInstallationGetSettingsResponse;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AppInstallationRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class AppInstallationRawService implements AppInstallationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * The settings of the App Installation of the app token, with the secret values. The token
     * grant gives the installation. The token needs `app_settings:read`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppInstallationGetSettingsResponse>
     *
     * @throws APIException
     */
    public function retrieveSettings(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'app-installation/settings',
            options: $requestOptions,
            convert: AppInstallationGetSettingsResponse::class,
        );
    }
}
