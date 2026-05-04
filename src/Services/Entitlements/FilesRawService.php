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
     * Detach a previously-attached file from a `digital_files` entitlement.
     *
     * @param string $fileID Identifier of the attached file
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
     * Attach a file to a `digital_files` entitlement. Per-file size cap: 500 MiB.
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
