<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Request body for creating a discount.

`code` is optional; if not provided, we generate a random 16-char code.
 */
class CreateDiscountRequest
{
    /**
	 * The discount amount.

- If `discount_type` is ``not`` `percentage`, `amount` is in ``USD cents``. For example, `100` means `$1.00`.
Only USD is allowed.
- If `discount_type` ``is`` `percentage`, `amount` is in ``basis points``. For example, `540` means `5.4%`.

Must be at least 1.
	 */
    #[SerializedName('amount')]
    public int $amount;

    /**
	 * Optionally supply a code (will be uppercased).
- Must be at least 3 characters if provided.
- If omitted, a random 16-character code is generated.
	 */
    #[SerializedName('code')]
    public ?string $code;

    /**
     * When the discount expires, if ever.
     */
    #[SerializedName('expires_at')]
    public ?string $expiresAt;

    #[SerializedName('name')]
    public ?string $name;

    /**
     * @var string[]|null
     * List of product IDs to restrict usage (if any).
     */
    #[SerializedName('restricted_to')]
    public ?array $restrictedTo;

    #[SerializedName('type')]
    public DiscountType $type;

    /**
	 * How many times this discount can be used (if any).
Must be >= 1 if provided.
	 */
    #[SerializedName('usage_limit')]
    public ?int $usageLimit;

    public function __construct(
        int $amount,
        ?string $code = null,
        ?string $expiresAt = null,
        ?string $name = null,
        ?array $restrictedTo = [],
        DiscountType $type,
        ?int $usageLimit = null
    ) {
        $this->amount = $amount;
        $this->code = $code;
        $this->expiresAt = $expiresAt;
        $this->name = $name;
        $this->restrictedTo = $restrictedTo;
        $this->type = $type;
        $this->usageLimit = $usageLimit;
    }
}
