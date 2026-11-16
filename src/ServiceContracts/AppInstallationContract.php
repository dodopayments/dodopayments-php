<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\AppInstallation\AppInstallationGetSettingsResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface AppInstallationContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveSettings(
        RequestOptions|array|null $requestOptions = null
    ): AppInstallationGetSettingsResponse;
}
