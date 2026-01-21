<?php

declare(strict_types=1);

namespace Dodopayments\Discounts;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * GET /discounts.
 *
 * @see Dodopayments\Services\DiscountsService::list()
 *
 * @phpstan-type DiscountListParamsShape = array{
 *   active?: bool|null,
 *   code?: string|null,
 *   discountType?: null|DiscountType|value-of<DiscountType>,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 *   productID?: string|null,
 * }
 */
final class DiscountListParams implements BaseModel
{
    /** @use SdkModel<DiscountListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by active status (true = not expired, false = expired).
     */
    #[Optional]
    public ?bool $active;

    /**
     * Filter by discount code (partial match, case-insensitive).
     */
    #[Optional]
    public ?string $code;

    /**
     * Filter by discount type (percentage).
     *
     * @var value-of<DiscountType>|null $discountType
     */
    #[Optional(enum: DiscountType::class)]
    public ?string $discountType;

    /**
     * Page number (default = 0).
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size (default = 10, max = 100).
     */
    #[Optional]
    public ?int $pageSize;

    /**
     * Filter by product restriction (only discounts that apply to this product).
     */
    #[Optional]
    public ?string $productID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param DiscountType|value-of<DiscountType>|null $discountType
     */
    public static function with(
        ?bool $active = null,
        ?string $code = null,
        DiscountType|string|null $discountType = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
    ): self {
        $self = new self;

        null !== $active && $self['active'] = $active;
        null !== $code && $self['code'] = $code;
        null !== $discountType && $self['discountType'] = $discountType;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;
        null !== $productID && $self['productID'] = $productID;

        return $self;
    }

    /**
     * Filter by active status (true = not expired, false = expired).
     */
    public function withActive(bool $active): self
    {
        $self = clone $this;
        $self['active'] = $active;

        return $self;
    }

    /**
     * Filter by discount code (partial match, case-insensitive).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Filter by discount type (percentage).
     *
     * @param DiscountType|value-of<DiscountType> $discountType
     */
    public function withDiscountType(DiscountType|string $discountType): self
    {
        $self = clone $this;
        $self['discountType'] = $discountType;

        return $self;
    }

    /**
     * Page number (default = 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size (default = 10, max = 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by product restriction (only discounts that apply to this product).
     */
    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }
}
