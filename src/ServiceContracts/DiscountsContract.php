<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\RequestOptions;

interface DiscountsContract
{
    /**
     * @api
     *
     * @param int $amount The discount amount.
     *
     * - If `discount_type` is **not** `percentage`, `amount` is in **USD cents**. For example, `100` means `$1.00`.
     *   Only USD is allowed.
     * - If `discount_type` **is** `percentage`, `amount` is in **basis points**. For example, `540` means `5.4%`.
     *
     * Must be at least 1.
     * @param 'percentage'|DiscountType $type The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     * @param string|null $code Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     * @param string|\DateTimeInterface|null $expiresAt when the discount expires, if ever
     * @param list<string>|null $restrictedTo list of product IDs to restrict usage (if any)
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param int|null $usageLimit How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string|DiscountType $type,
        ?string $code = null,
        string|\DateTimeInterface|null $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
        ?RequestOptions $requestOptions = null,
    ): Discount;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): Discount;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param int|null $amount If present, update the discount amount:
     * - If `discount_type` is `percentage`, this represents **basis points** (e.g., `540` = `5.4%`).
     * - Otherwise, this represents **USD cents** (e.g., `100` = `$1.00`).
     *
     * Must be at least 1 if provided.
     * @param string|null $code if present, update the discount code (uppercase)
     * @param list<string>|null $restrictedTo If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param 'percentage'|DiscountType|null $type if present, update the discount type
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        ?int $amount = null,
        ?string $code = null,
        string|\DateTimeInterface|null $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        string|DiscountType|null $type = null,
        ?int $usageLimit = null,
        ?RequestOptions $requestOptions = null,
    ): Discount;

    /**
     * @api
     *
     * @param int $pageNumber page number (default = 0)
     * @param int $pageSize page size (default = 10, max = 100)
     *
     * @return DefaultPageNumberPagination<Discount>
     *
     * @throws APIException
     */
    public function list(
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
