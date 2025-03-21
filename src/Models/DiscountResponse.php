<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class DiscountResponse
{
    /**
	 * The discount amount.

- If `discount_type` is `percentage`, this is in ``basis points``
(e.g., 540 => 5.4%).
- Otherwise, this is ``USD cents`` (e.g., 100 => `$1.00`).
	 */
    #[SerializedName('amount')]
    public int $amount;

    /**
     * The business this discount belongs to.
     */
    #[SerializedName('business_id')]
    public string $businessId;

    /**
     * The discount code (up to 16 chars).
     */
    #[SerializedName('code')]
    public string $code;

    /**
     * Timestamp when the discount is created
     */
    #[SerializedName('created_at')]
    public string $createdAt;

    /**
     * The unique discount ID
     */
    #[SerializedName('discount_id')]
    public string $discountId;

    /**
     * Optional date/time after which discount is expired.
     */
    #[SerializedName('expires_at')]
    public ?string $expiresAt;

    /**
     * Name for the Discount
     */
    #[SerializedName('name')]
    public ?string $name;

    /**
     * @var string[]
     * List of product IDs to which this discount is restricted.
     */
    #[SerializedName('restricted_to')]
    public array $restrictedTo;

    /**
     * How many times this discount has been used.
     */
    #[SerializedName('times_used')]
    public int $timesUsed;

    #[SerializedName('type')]
    public DiscountType $type;

    /**
     * Usage limit for this discount, if any.
     */
    #[SerializedName('usage_limit')]
    public ?int $usageLimit;

    public function __construct(
        int $amount,
        string $businessId,
        string $code,
        string $createdAt,
        string $discountId,
        ?string $expiresAt = null,
        ?string $name = null,
        array $restrictedTo,
        int $timesUsed,
        DiscountType $type,
        ?int $usageLimit = null
    ) {
        $this->amount = $amount;
        $this->businessId = $businessId;
        $this->code = $code;
        $this->createdAt = $createdAt;
        $this->discountId = $discountId;
        $this->expiresAt = $expiresAt;
        $this->name = $name;
        $this->restrictedTo = $restrictedTo;
        $this->timesUsed = $timesUsed;
        $this->type = $type;
        $this->usageLimit = $usageLimit;
    }
}
