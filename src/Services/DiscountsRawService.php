<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DiscountsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class DiscountsRawService implements DiscountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * POST /discounts
     * If `code` is omitted or empty, a random 16-char uppercase code is generated.
     *
     * @param array{
     *   amount: int,
     *   type: DiscountType|value-of<DiscountType>,
     *   code?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   name?: string|null,
     *   restrictedTo?: list<string>|null,
     *   subscriptionCycles?: int|null,
     *   usageLimit?: int|null,
     * }|DiscountCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function create(
        array|DiscountCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DiscountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'discounts',
            body: (object) $parsed,
            options: $options,
            convert: Discount::class,
        );
    }

    /**
     * @api
     *
     * GET /discounts/{discount_id}
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['discounts/%1$s', $discountID],
            options: $requestOptions,
            convert: Discount::class,
        );
    }

    /**
     * @api
     *
     * PATCH /discounts/{discount_id}
     *
     * @param string $discountID Discount Id
     * @param array{
     *   amount?: int|null,
     *   code?: string|null,
     *   expiresAt?: \DateTimeInterface|null,
     *   name?: string|null,
     *   restrictedTo?: list<string>|null,
     *   subscriptionCycles?: int|null,
     *   type?: DiscountType|value-of<DiscountType>|null,
     *   usageLimit?: int|null,
     * }|DiscountUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        array|DiscountUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DiscountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['discounts/%1$s', $discountID],
            body: (object) $parsed,
            options: $options,
            convert: Discount::class,
        );
    }

    /**
     * @api
     *
     * GET /discounts
     *
     * @param array{
     *   active?: bool,
     *   code?: string,
     *   discountType?: DiscountType|value-of<DiscountType>,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   productID?: string,
     * }|DiscountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DefaultPageNumberPagination<Discount>>
     *
     * @throws APIException
     */
    public function list(
        array|DiscountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DiscountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'discounts',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'discountType' => 'discount_type',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'productID' => 'product_id',
                ],
            ),
            options: $options,
            convert: Discount::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * DELETE /discounts/{discount_id}
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['discounts/%1$s', $discountID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Validate and fetch a discount by its code name (e.g., "SAVE20").
     * This allows real-time validation directly against the API using the
     * human-readable discount code instead of requiring the internal discount_id.
     *
     * @param string $code The discount code (e.g., 'SAVE20')
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Discount>
     *
     * @throws APIException
     */
    public function retrieveByCode(
        string $code,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['discounts/code/%1$s', $code],
            options: $requestOptions,
            convert: Discount::class,
        );
    }
}
