<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\CustomersService::list()
 *
 * @phpstan-type CustomerListParamsShape = array{
 *   email?: string|null, pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class CustomerListParams implements BaseModel
{
    /** @use SdkModel<CustomerListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by customer email.
     */
    #[Optional]
    public ?string $email;

    /**
     * Page number default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size default is 10 max is 100.
     */
    #[Optional]
    public ?int $pageSize;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $email = null,
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by customer email.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Page number default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size default is 10 max is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
