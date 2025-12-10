<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Webhooks;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\RequestOptions;
use Dodopayments\Webhooks\Headers\HeaderGetResponse;
use Dodopayments\Webhooks\Headers\HeaderUpdateParams;

interface HeadersRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<HeaderGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|HeaderUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|HeaderUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
