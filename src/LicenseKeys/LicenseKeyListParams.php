<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;

/**
 * @see Dodopayments\LicenseKeys->list
 *
 * @phpstan-type license_key_list_params = array{
 *   customerID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   productID?: string,
 *   status?: Status::*,
 * }
 */
final class LicenseKeyListParams implements BaseModel
{
    /** @use SdkModel<license_key_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by customer ID.
     */
    #[Api(optional: true)]
    public ?string $customerID;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $pageSize;

    /**
     * Filter by product ID.
     */
    #[Api(optional: true)]
    public ?string $productID;

    /**
     * Filter by license key status.
     *
     * @var Status::*|null $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status::* $status
     */
    public static function with(
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        ?string $productID = null,
        ?string $status = null,
    ): self {
        $obj = new self;

        null !== $customerID && $obj->customerID = $customerID;
        null !== $pageNumber && $obj->pageNumber = $pageNumber;
        null !== $pageSize && $obj->pageSize = $pageSize;
        null !== $productID && $obj->productID = $productID;
        null !== $status && $obj->status = $status;

        return $obj;
    }

    /**
     * Filter by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->pageNumber = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->pageSize = $pageSize;

        return $obj;
    }

    /**
     * Filter by product ID.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->productID = $productID;

        return $obj;
    }

    /**
     * Filter by license key status.
     *
     * @param Status::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }
}
