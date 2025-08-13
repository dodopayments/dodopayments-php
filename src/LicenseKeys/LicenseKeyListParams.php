<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKeyListParams\Status;

/**
 * @phpstan-type list_params = array{
 *   customerID?: string,
 *   pageNumber?: int,
 *   pageSize?: int,
 *   productID?: string,
 *   status?: Status::*,
 * }
 */
final class LicenseKeyListParams implements BaseModel
{
    use Model;
    use Params;

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
     * @var null|Status::* $status
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
     * @param null|Status::* $status
     */
    public static function from(
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
    public function setCustomerID(string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    /**
     * Page number default is 0.
     */
    public function setPageNumber(int $pageNumber): self
    {
        $this->pageNumber = $pageNumber;

        return $this;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;

        return $this;
    }

    /**
     * Filter by product ID.
     */
    public function setProductID(string $productID): self
    {
        $this->productID = $productID;

        return $this;
    }

    /**
     * Filter by license key status.
     *
     * @param Status::* $status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
