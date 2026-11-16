<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\AppInstallation\AppInstallationGetSettingsResponse;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface AppInstallationRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AppInstallationGetSettingsResponse>
     *
     * @throws APIException
     */
    public function retrieveSettings(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
