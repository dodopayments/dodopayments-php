<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicenseKeyInstancesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LicenseKeyInstancesService implements LicenseKeyInstancesContract
{
    /**
     * @api
     */
    public LicenseKeyInstancesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LicenseKeyInstancesRawService($client);
    }

    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): LicenseKeyInstance {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id License key instance ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        string $name,
        RequestOptions|array|null $requestOptions = null
    ): LicenseKeyInstance {
        $params = Util::removeNulls(['name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string|null $licenseKeyID Filter by license key ID
     * @param int|null $pageNumber Page number default is 0
     * @param int|null $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function list(
        ?string $licenseKeyID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'licenseKeyID' => $licenseKeyID,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
