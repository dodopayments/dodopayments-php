<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DiscountsContract;

final class DiscountsService implements DiscountsContract
{
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
     *   type: 'percentage'|DiscountType,
     *   code?: string|null,
     *   expires_at?: string|\DateTimeInterface|null,
     *   name?: string|null,
     *   restricted_to?: list<string>|null,
     *   subscription_cycles?: int|null,
     *   usage_limit?: int|null,
     * }|DiscountCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|DiscountCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Discount {
        [$parsed, $options] = DiscountCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): Discount {
        // @phpstan-ignore-next-line;
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
     * @param array{
     *   amount?: int|null,
     *   code?: string|null,
     *   expires_at?: string|\DateTimeInterface|null,
     *   name?: string|null,
     *   restricted_to?: list<string>|null,
     *   subscription_cycles?: int|null,
     *   type?: 'percentage'|DiscountType|null,
     *   usage_limit?: int|null,
     * }|DiscountUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        array|DiscountUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Discount {
        [$parsed, $options] = DiscountUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     * @param array{page_number?: int, page_size?: int}|DiscountListParams $params
     *
     * @return DefaultPageNumberPagination<Discount>
     *
     * @throws APIException
     */
    public function list(
        array|DiscountListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = DiscountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'discounts',
            query: $parsed,
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
     * @throws APIException
     */
    public function delete(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['discounts/%1$s', $discountID],
            options: $requestOptions,
            convert: null,
        );
    }
}
