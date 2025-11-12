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
 * @phpstan-type LicenseKeyListParamsShape = array{
 *   customer_id?: string,
 *   page_number?: int,
 *   page_size?: int,
 *   product_id?: string,
 *   status?: Status|value-of<Status>,
 * }
 */
final class LicenseKeyListParams implements BaseModel
{
    /** @use SdkModel<LicenseKeyListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by customer ID.
     */
    #[Api(optional: true)]
    public ?string $customer_id;

    /**
     * Page number default is 0.
     */
    #[Api(optional: true)]
    public ?int $page_number;

    /**
     * Page size default is 10 max is 100.
     */
    #[Api(optional: true)]
    public ?int $page_size;

    /**
     * Filter by product ID.
     */
    #[Api(optional: true)]
    public ?string $product_id;

    /**
     * Filter by license key status.
     *
     * @var value-of<Status>|null $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(
        ?string $customer_id = null,
        ?int $page_number = null,
        ?int $page_size = null,
        ?string $product_id = null,
        Status|string|null $status = null,
    ): self {
        $obj = new self;

        null !== $customer_id && $obj->customer_id = $customer_id;
        null !== $page_number && $obj->page_number = $page_number;
        null !== $page_size && $obj->page_size = $page_size;
        null !== $product_id && $obj->product_id = $product_id;
        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Filter by customer ID.
     */
    public function withCustomerID(string $customerID): self
    {
        $obj = clone $this;
        $obj->customer_id = $customerID;

        return $obj;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $obj = clone $this;
        $obj->page_number = $pageNumber;

        return $obj;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }

    /**
     * Filter by product ID.
     */
    public function withProductID(string $productID): self
    {
        $obj = clone $this;
        $obj->product_id = $productID;

        return $obj;
    }

    /**
     * Filter by license key status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
