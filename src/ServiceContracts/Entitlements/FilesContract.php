<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Entitlements\Files\FileUploadResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface FilesContract
{
    /**
     * @api
     *
     * @param string $fileID Identifier of the attached file
     * @param string $id Entitlement Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $id Entitlement Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): FileUploadResponse;
}
