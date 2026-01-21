<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;
use Dodopayments\LicenseKeys\LicenseKeyUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\LicenseKeysRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LicenseKeysRawService implements LicenseKeysRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $id License key ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['license_keys/%1$s', $id],
            options: $requestOptions,
            convert: LicenseKey::class,
        );
    }

    /**
     * @api
     *
     * @param string $id License key ID
     * @param array{
     *   activationsLimit?: int|null,
     *   disabled?: bool|null,
     *   expiresAt?: \DateTimeInterface|null,
     * }|LicenseKeyUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LicenseKey>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LicenseKeyUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['license_keys/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: LicenseKey::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   createdAtGte?: \DateTimeInterface,
     *   createdAtLte?: \DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   productID?: string,
     *   status?: Status|value-of<Status>,
     * }|LicenseKeyListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<LicenseKey>>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = LicenseKeyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'license_keys',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'productID' => 'product_id',
                ],
            ),
            options: $options,
            convert: LicenseKey::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
