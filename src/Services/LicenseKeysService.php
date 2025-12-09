<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use Dodopayments\LicenseKeys\LicenseKeyListParams;
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
     *   activations_limit?: int|null,
     *   disabled?: bool|null,
     *   expires_at?: string|\DateTimeInterface|null,
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
     *   customer_id?: string,
     *   page_number?: int,
     *   page_size?: int,
     *   product_id?: string,
     *   status?: 'active'|'expired'|'disabled',
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
            query: $parsed,
            options: $options,
            convert: LicenseKey::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }
}
