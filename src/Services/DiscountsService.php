<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Contracts\DiscountsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

final class DiscountsService implements DiscountsContract
{
    public function __construct(private Client $client) {}

    /**
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
     * @param DiscountType::* $type The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
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
     * @param DiscountType::* $type if present, update the discount type
     * @param int|null $usageLimit
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
     * @param int $pageNumber page number (default = 0)
     * @param int $pageSize page size (default = 10, max = 100)
     */
    public function list(
        $pageNumber = omit,
        $pageSize = omit,
        ?RequestOptions $requestOptions = null
    ): Discount {
        [$parsed, $options] = DiscountListParams::parseRequest(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize],
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
