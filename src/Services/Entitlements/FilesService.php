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
     * Companion to `post_entitlement_file`. Deletes the file from the
     * Entitlements Engine (force=true) and atomically removes the `file_id`
     * from the entitlement's `integration_config.digital_file_ids` JSONB
     * array. EE delete happens first; if it fails we surface the error and
     * leave local state untouched.
     *
     * @param string $fileID Digital file Id from EE
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
     * Streams a multipart/form-data body to the Entitlements Engine
     * (`POST /api/digital-files/dodo/files/upload`) and appends the returned
     * `file_id` to the entitlement's `integration_config.digital_file_ids`
     * using a JSONB array append. Compensates EE-side on local DB write
     * failure (best-effort delete of the just-uploaded file).
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
