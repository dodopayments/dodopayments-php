<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
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
     * @param DiscountType|value-of<DiscountType> $type The discount type (e.g. `percentage`, `flat`, or `flat_per_unit`).
     * @param string|null $code Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     * @param \DateTimeInterface|null $expiresAt when the discount expires, if ever
     * @param list<string>|null $restrictedTo list of product IDs to restrict usage (if any)
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param int|null $usageLimit How many times this discount can be used (if any).
     * Must be >= 1 if provided.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        DiscountType|string $type,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Discount;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
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
     * @param DiscountType|value-of<DiscountType>|null $type if present, update the discount type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        ?int $amount = null,
        ?string $code = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = null,
        ?int $subscriptionCycles = null,
        DiscountType|string|null $type = null,
        ?int $usageLimit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Discount;

    /**
     * @api
     *
     * @param int $pageNumber page number (default = 0)
     * @param int $pageSize page size (default = 10, max = 100)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Discount>
     *
     * @throws APIException
     */
    public function list(
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
