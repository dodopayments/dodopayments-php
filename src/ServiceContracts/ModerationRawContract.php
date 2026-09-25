<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Moderation\ModerationGetUsageResponse;
use Dodopayments\Moderation\ModerationScreenParams;
use Dodopayments\Moderation\ModerationScreenResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ModerationRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ModerationGetUsageResponse>
     *
     * @throws APIException
     */
    public function retrieveUsage(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ModerationScreenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ModerationScreenResponse>
     *
     * @throws APIException
     */
    public function screen(
        array|ModerationScreenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
