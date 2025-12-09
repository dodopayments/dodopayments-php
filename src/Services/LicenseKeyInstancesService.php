<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicenseKeyInstancesContract;

final class LicenseKeyInstancesService implements LicenseKeyInstancesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): LicenseKeyInstance {
        /** @var BaseResponse<LicenseKeyInstance> */
        $response = $this->client->request(
            method: 'get',
            path: ['license_key_instances/%1$s', $id],
            options: $requestOptions,
            convert: LicenseKeyInstance::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{name: string}|LicenseKeyInstanceUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyInstanceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKeyInstance {
        [$parsed, $options] = LicenseKeyInstanceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<LicenseKeyInstance> */
        $response = $this->client->request(
            method: 'patch',
            path: ['license_key_instances/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: LicenseKeyInstance::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   licenseKeyID?: string|null, pageNumber?: int|null, pageSize?: int|null
     * }|LicenseKeyInstanceListParams $params
     *
     * @return DefaultPageNumberPagination<LicenseKeyInstance>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyInstanceListParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = LicenseKeyInstanceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<LicenseKeyInstance>> */
        $response = $this->client->request(
            method: 'get',
            path: 'license_key_instances',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'licenseKeyID' => 'license_key_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                ],
            ),
            options: $options,
            convert: LicenseKeyInstance::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }
}
