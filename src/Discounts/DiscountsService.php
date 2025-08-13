<?php

declare(strict_types=1);

namespace DodopaymentsClient\Discounts;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\DiscountsContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\RequestOptions;

final class DiscountsService implements DiscountsContract
{
    public function __construct(private Client $client) {}

    /**
     * POST /discounts
     * If `code` is omitted or empty, a random 16-char uppercase code is generated.
     *
     * @param array{
     *   amount: int,
     *   type: DiscountType::*,
     *   code?: null|string,
     *   expiresAt?: null|\DateTimeInterface,
     *   name?: null|string,
     *   restrictedTo?: null|list<string>,
     *   subscriptionCycles?: null|int,
     *   usageLimit?: null|int,
     * }|DiscountCreateParams $params
     */
    public function create(
        array|DiscountCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): Discount {
        [$parsed, $options] = DiscountCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'discounts',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Discount::class, value: $resp);
    }

    /**
     * GET /discounts/{discount_id}.
     */
    public function retrieve(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): Discount {
        $resp = $this->client->request(
            method: 'get',
            path: ['discounts/%1$s', $discountID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Discount::class, value: $resp);
    }

    /**
     * PATCH /discounts/{discount_id}.
     *
     * @param array{
     *   amount?: null|int,
     *   code?: null|string,
     *   expiresAt?: null|\DateTimeInterface,
     *   name?: null|string,
     *   restrictedTo?: null|list<string>,
     *   subscriptionCycles?: null|int,
     *   type?: DiscountType::*,
     *   usageLimit?: null|int,
     * }|DiscountUpdateParams $params
     */
    public function update(
        string $discountID,
        array|DiscountUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Discount {
        [$parsed, $options] = DiscountUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'patch',
            path: ['discounts/%1$s', $discountID],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Discount::class, value: $resp);
    }

    /**
     * GET /discounts.
     *
     * @param array{pageNumber?: int, pageSize?: int}|DiscountListParams $params
     */
    public function list(
        array|DiscountListParams $params,
        ?RequestOptions $requestOptions = null
    ): Discount {
        [$parsed, $options] = DiscountListParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'discounts',
            query: $parsed,
            options: $options
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(Discount::class, value: $resp);
    }

    /**
     * DELETE /discounts/{discount_id}.
     */
    public function delete(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        return $this->client->request(
            method: 'delete',
            path: ['discounts/%1$s', $discountID],
            options: $requestOptions,
        );
    }
}
