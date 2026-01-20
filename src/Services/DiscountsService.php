<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DiscountsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class DiscountsService implements DiscountsContract
{
    /**
     * @api
     */
    public DiscountsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DiscountsRawService($client);
    }

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
    ): Discount {
        $params = Util::removeNulls(
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
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * GET /discounts/{discount_id}
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): Discount {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($discountID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * PATCH /discounts/{discount_id}
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
    ): Discount {
        $params = Util::removeNulls(
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
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($discountID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * GET /discounts
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
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            ['pageNumber' => $pageNumber, 'pageSize' => $pageSize]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * DELETE /discounts/{discount_id}
     *
     * @param string $discountID Discount Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $discountID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($discountID, requestOptions: $requestOptions);

        return $response->parse();
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
     * @throws APIException
     */
    public function retrieveByCode(
        string $code,
        RequestOptions|array|null $requestOptions = null
    ): Discount {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveByCode($code, requestOptions: $requestOptions);

        return $response->parse();
    }
}
