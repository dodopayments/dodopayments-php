<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\ShortLinks\ShortLinkCreateParams;
use Dodopayments\Products\ShortLinks\ShortLinkListParams;
use Dodopayments\Products\ShortLinks\ShortLinkListResponse;
use Dodopayments\Products\ShortLinks\ShortLinkNewResponse;
use Dodopayments\RequestOptions;

interface ShortLinksRawContract
{
    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<string,mixed>|ShortLinkCreateParams $params
     *
     * @return BaseResponse<ShortLinkNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|ShortLinkCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ShortLinkListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<ShortLinkListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ShortLinkListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
