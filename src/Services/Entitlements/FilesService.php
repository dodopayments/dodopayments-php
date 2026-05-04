<?php

declare(strict_types=1);

namespace Dodopayments\Services\Entitlements;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Entitlements\Files\FileUploadResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Entitlements\FilesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class FilesService implements FilesContract
{
    /**
     * @api
     */
    public FilesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new FilesRawService($client);
    }

    /**
     * @api
     *
     * Detach a previously-attached file from a `digital_files` entitlement.
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
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($fileID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Attach a file to a `digital_files` entitlement. Per-file size cap: 500 MiB.
     *
     * @param string $id Entitlement Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): FileUploadResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
