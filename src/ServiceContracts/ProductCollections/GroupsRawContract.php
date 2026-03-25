<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\ProductCollections;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\ProductCollections\Groups\GroupCreateParams;
use Dodopayments\ProductCollections\Groups\GroupDeleteParams;
use Dodopayments\ProductCollections\Groups\GroupNewResponse;
use Dodopayments\ProductCollections\Groups\GroupUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface GroupsRawContract
{
    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param array<string,mixed>|GroupCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<GroupNewResponse>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|GroupCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $groupID Path param: Product Collection Group Id
     * @param array<string,mixed>|GroupUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $groupID,
        array|GroupUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $groupID Product Collection Group Id
     * @param array<string,mixed>|GroupDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $groupID,
        array|GroupDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
