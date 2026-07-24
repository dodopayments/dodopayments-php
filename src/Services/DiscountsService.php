<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountCreateParams\CurrencyOption;
use Dodopayments\Discounts\DiscountCreateParams\CustomerEligibility;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\DiscountsContract;

/**
 * @phpstan-import-type CurrencyOptionShape from \Dodopayments\Discounts\DiscountCreateParams\CurrencyOption
 * @phpstan-import-type CurrencyOptionShape from \Dodopayments\Discounts\DiscountUpdateParams\CurrencyOption as CurrencyOptionShape1
 * @phpstan-import-type MetadataItemShape from \Dodopayments\Misc\MetadataItem
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
     * @param int $amount The discount amount in **basis points** (e.g. `540` means `5.4%`, `10000` means `100%`).
     *
     * Must be at least 1.
     * @param DiscountType|value-of<DiscountType> $type the discount type: `percentage` or `flat` (`flat_per_unit` stays blocked)
     * @param string|null $code Optionally supply a code (will be uppercased).
     * - Must be at least 3 characters if provided.
     * - If omitted, a random 16-character code is generated.
     * @param list<CurrencyOption|CurrencyOptionShape>|null $currencyOptions Per-currency options (flat deduction / percentage cap + minimum subtotal).
     * Required for `flat` codes (must include a resolvable default); optional
     * per-currency caps for `percentage` codes. Per-row invariants are checked
     * in `normalize_currency_options`, not via `#[validate(nested)]`.
     * @param CustomerEligibility|value-of<CustomerEligibility>|null $customerEligibility Who may redeem this discount code. Defaults to `any` (unrestricted).
     * `specific` starts with zero attached customers (fails closed) until
     * customers are attached via `POST /discounts/{id}/customers`.
     * @param \DateTimeInterface|null $expiresAt when the discount expires, if ever
     * @param array<string,MetadataItemShape> $metadata Additional metadata for the discount
     * @param int|null $perCustomerUsageLimit Maximum number of times a single customer may redeem this discount.
     * Must be `<= usage_limit` when both are set.
     * @param bool $preserveOnPlanChange Whether this discount should be preserved when a subscription changes plans.
     * Default: false (discount is removed on plan change)
     * @param list<string>|null $restrictedTo list of product IDs to restrict usage (if any)
     * @param \DateTimeInterface|null $startsAt When the discount becomes active, if scheduled for the future.
     * NULL = active immediately. Must be strictly before `expires_at` when both are set.
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
        ?array $currencyOptions = null,
        CustomerEligibility|string|null $customerEligibility = null,
        ?\DateTimeInterface $expiresAt = null,
        ?array $metadata = null,
        ?string $name = null,
        ?int $perCustomerUsageLimit = null,
        ?bool $preserveOnPlanChange = null,
        ?array $restrictedTo = null,
        ?\DateTimeInterface $startsAt = null,
        ?int $subscriptionCycles = null,
        ?int $usageLimit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Discount {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'type' => $type,
                'code' => $code,
                'currencyOptions' => $currencyOptions,
                'customerEligibility' => $customerEligibility,
                'expiresAt' => $expiresAt,
                'metadata' => $metadata,
                'name' => $name,
                'perCustomerUsageLimit' => $perCustomerUsageLimit,
                'preserveOnPlanChange' => $preserveOnPlanChange,
                'restrictedTo' => $restrictedTo,
                'startsAt' => $startsAt,
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
     * @param int|null $amount If present, update the discount amount in **basis points** (e.g., `540` = `5.4%`, `10000` = `100%`).
     *
     * Must be at least 1 if provided.
     * @param string|null $code if present, update the discount code (uppercase)
     * @param list<\Dodopayments\Discounts\DiscountUpdateParams\CurrencyOption|CurrencyOptionShape1>|null $currencyOptions If present, fully replaces the discount's currency options (replace-set
     * semantics, like `restricted_to`). Send an empty array to clear them.
     * @param \Dodopayments\Discounts\DiscountUpdateParams\CustomerEligibility|value-of<\Dodopayments\Discounts\DiscountUpdateParams\CustomerEligibility>|null $customerEligibility If present, update who may redeem this discount. Plain field (not
     * double-option): the DB column is `NOT NULL`, so it can never be cleared
     * back to unset, only changed to another `CustomerEligibility` value.
     * @param array<string,MetadataItemShape>|null $metadata Additional metadata for the discount
     * @param int|null $perCustomerUsageLimit If present, update the per-customer usage limit (double-option: send
     * `null` to clear it back to unlimited). Must be `<= usage_limit` (the
     * value in effect after this patch) when both are set.
     * @param bool|null $preserveOnPlanChange Whether this discount should be preserved when a subscription changes plans.
     * If not provided, the existing value is kept.
     * @param list<string>|null $restrictedTo If present, replaces all restricted product IDs with this new set.
     * To remove all restrictions, send empty array
     * @param \DateTimeInterface|null $startsAt if present, update `starts_at` (double-option: send `null` to clear it)
     * @param int|null $subscriptionCycles Number of subscription billing cycles this discount is valid for.
     * If not provided, the discount will be applied indefinitely to
     * all recurring payments related to the subscription.
     * @param DiscountType|value-of<DiscountType>|null $type if present, update the discount type (`percentage` or `flat`)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $discountID,
        ?int $amount = null,
        ?string $code = null,
        ?array $currencyOptions = null,
        \Dodopayments\Discounts\DiscountUpdateParams\CustomerEligibility|string|null $customerEligibility = null,
        ?\DateTimeInterface $expiresAt = null,
        ?array $metadata = null,
        ?string $name = null,
        ?int $perCustomerUsageLimit = null,
        ?bool $preserveOnPlanChange = null,
        ?array $restrictedTo = null,
        ?\DateTimeInterface $startsAt = null,
        ?int $subscriptionCycles = null,
        DiscountType|string|null $type = null,
        ?int $usageLimit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Discount {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'code' => $code,
                'currencyOptions' => $currencyOptions,
                'customerEligibility' => $customerEligibility,
                'expiresAt' => $expiresAt,
                'metadata' => $metadata,
                'name' => $name,
                'perCustomerUsageLimit' => $perCustomerUsageLimit,
                'preserveOnPlanChange' => $preserveOnPlanChange,
                'restrictedTo' => $restrictedTo,
                'startsAt' => $startsAt,
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
     * @param bool $active Filter by active status. `true` = currently redeemable (started, not
     * expired, not usage-exhausted). `false` = not currently redeemable
     * (expired, usage-exhausted, or pending a future `starts_at`).
     * @param string $code Filter by discount code (partial match, case-insensitive)
     * @param DiscountType|value-of<DiscountType> $discountType Filter by discount type
     * @param int $pageNumber page number (default = 0)
     * @param int $pageSize page size (default = 10, max = 100)
     * @param string $productID Filter by product restriction (only discounts that apply to this product)
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<Discount>
     *
     * @throws APIException
     */
    public function list(
        ?bool $active = null,
        ?string $code = null,
        DiscountType|string|null $discountType = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'active' => $active,
                'code' => $code,
                'discountType' => $discountType,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
                'productID' => $productID,
            ],
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
