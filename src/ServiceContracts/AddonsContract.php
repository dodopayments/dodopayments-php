<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Addons\AddonCreateParams;
use Dodopayments\Addons\AddonListParams;
use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Addons\AddonUpdateParams;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\RequestOptions;

interface AddonsContract
{
    /**
     * @api
     *
     * @param array<mixed>|AddonCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|AddonCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonResponse;

    /**
     * @api
     *
     * @param array<mixed>|AddonUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|AddonUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AddonResponse;

    /**
     * @api
     *
     * @param array<mixed>|AddonListParams $params
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AddonListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?RequestOptions $requestOptions = null
    ): AddonUpdateImagesResponse;
}
