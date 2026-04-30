<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Entitlements\Files\FileDeleteParams;
use Dodopayments\Entitlements\Files\FileUploadResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface FilesRawContract
{
    /**
     * @api
     *
     * @param string $fileID Digital file Id from EE
     * @param array<string,mixed>|FileDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        array|FileDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Entitlement Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<FileUploadResponse>
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
