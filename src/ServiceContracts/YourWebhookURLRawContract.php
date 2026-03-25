<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface YourWebhookURLRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|YourWebhookURLCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|YourWebhookURLCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
