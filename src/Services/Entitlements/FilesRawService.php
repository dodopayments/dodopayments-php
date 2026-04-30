<?php

declare(strict_types=1);

namespace Dodopayments\Services\Entitlements;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Entitlements\Files\FileDeleteParams;
use Dodopayments\Entitlements\Files\FileUploadResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Entitlements\FilesRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class FilesRawService implements FilesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Companion to `post_entitlement_file`. Deletes the file from the
     * Entitlements Engine (force=true) and atomically removes the `file_id`
     * from the entitlement's `integration_config.digital_file_ids` JSONB
     * array. EE delete happens first; if it fails we surface the error and
     * leave local state untouched.
     *
     * @param string $fileID Digital file Id from EE
     * @param array{id: string}|FileDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = FileDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['entitlements/%1$s/files/%2$s', $id, $fileID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Streams a multipart/form-data body to the Entitlements Engine
     * (`POST /api/digital-files/dodo/files/upload`) and appends the returned
     * `file_id` to the entitlement's `integration_config.digital_file_ids`
     * using a JSONB array append. Compensates EE-side on local DB write
     * failure (best-effort delete of the just-uploaded file).
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['entitlements/%1$s/files', $id],
            options: $requestOptions,
            convert: FileUploadResponse::class,
        );
    }
}
