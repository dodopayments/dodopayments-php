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

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ShortLinksRawContract
{
    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<string,mixed>|ShortLinkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ShortLinkNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|ShortLinkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ShortLinkListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<ShortLinkListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|ShortLinkListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
