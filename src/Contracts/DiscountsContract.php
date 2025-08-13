<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;

interface DiscountsContract
{
    /**
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
        ?RequestOptions $requestOptions = null,
    ): Discount;

    public function retrieve(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): Discount;

    /**
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
    ): Discount;

    /**
     * @param array{pageNumber?: int, pageSize?: int}|DiscountListParams $params
     */
    public function list(
        array|DiscountListParams $params,
        ?RequestOptions $requestOptions = null
    ): Discount;

    public function delete(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
