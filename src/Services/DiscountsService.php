<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DiscountsContract;

use const Dodopayments\Core\OMIT as omit;

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
     * @param int $amount The discount amount.
     *
     * - If `discount_type` is **not** `percentage`, `amount` is in **USD cents**. For example, `100` means `$1.00`.
     *   Only USD is allowed.
     * - If `discount_type` **is** `percentage`, `amount` is in **basis points**. For example, `540` means `5.4%`.
     *
     * Must be at least 1.
     * @param DiscountType|value-of<DiscountType> $type The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     * @param string|null $code Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     * @param \DateTimeInterface|null $expiresAt when the discount expires, if ever
     * @param string|null $name
     * @param list<string>|null $restrictedTo list of product IDs to restrict usage (if any)
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param int|null $usageLimit How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     *
     * @return Discount<HasRawResponse>
     */
    public function create(
        $amount,
        $type,
        $code = omit,
        $expiresAt = omit,
        $name = omit,
        $restrictedTo = omit,
        $subscriptionCycles = omit,
        $usageLimit = omit,
        ?RequestOptions $requestOptions = null,
    ): Discount {
        [$parsed, $options] = DiscountCreateParams::parseRequest(
            [
                'amount' => $amount,
                'type' => $type,
                'code' => $code,
                'expiresAt' => $expiresAt,
                'name' => $name,
                'restrictedTo' => $restrictedTo,
                'subscriptionCycles' => $subscriptionCycles,
                'usageLimit' => $usageLimit,
            ],
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
     * @return Discount<HasRawResponse>
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
     * @param int|null $amount If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     * @param string|null $code if present, update the discount code (uppercase)
     * @param \DateTimeInterface|null $expiresAt
     * @param string|null $name
     * @param list<string>|null $restrictedTo If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param DiscountType|value-of<DiscountType>|null $type if present, update the discount type
     * @param int|null $usageLimit
     *
     * @return Discount<HasRawResponse>
     */
    public function update(
        string $discountID,
        $amount = omit,
        $code = omit,
        $expiresAt = omit,
        $name = omit,
        $restrictedTo = omit,
        $subscriptionCycles = omit,
        $type = omit,
        $usageLimit = omit,
        ?RequestOptions $requestOptions = null,
    ): Discount {
        [$parsed, $options] = DiscountUpdateParams::parseRequest(
            [
                'amount' => $amount,
                'code' => $code,
                'expiresAt' => $expiresAt,
                'name' => $name,
                'restrictedTo' => $restrictedTo,
                'subscriptionCycles' => $subscriptionCycles,
                'type' => $type,
                'usageLimit' => $usageLimit,
            ],
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
     * @param int $pageNumber page number (default = 0)
     * @param int $pageSize page size (default = 10, max = 100)
     *
     * @return DefaultPageNumberPagination<Discount>
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = DiscountListParams::parseRequest(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize],
            $requestOptions
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
