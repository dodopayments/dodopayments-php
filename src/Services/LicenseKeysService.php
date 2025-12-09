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
use Dodopayments\ServiceContracts\LicenseKeysContract;

final class LicenseKeysService implements LicenseKeysContract
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
    ): LicenseKey {
        /** @var BaseResponse<LicenseKey> */
        $response = $this->client->request(
            method: 'get',
            path: ['license_keys/%1$s', $id],
            options: $requestOptions,
            convert: LicenseKey::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   activationsLimit?: int|null,
     *   disabled?: bool|null,
     *   expiresAt?: string|\DateTimeInterface|null,
     * }|LicenseKeyUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|LicenseKeyUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): LicenseKey {
        [$parsed, $options] = LicenseKeyUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<LicenseKey> */
        $response = $this->client->request(
            method: 'patch',
            path: ['license_keys/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: LicenseKey::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   productID?: string,
     *   status?: 'active'|'expired'|'disabled'|Status,
     * }|LicenseKeyListParams $params
     *
     * @return DefaultPageNumberPagination<LicenseKey>
     *
     * @throws APIException
     */
    public function list(
        array|LicenseKeyListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = LicenseKeyListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<LicenseKey>> */
        $response = $this->client->request(
            method: 'get',
            path: 'license_keys',
            query: Util::array_transform_keys(
                $parsed,
                [
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

        return $response->parse();
    }
}
