<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns every transactional email sent to this customer in the last 180
 * days, newest first, with its delivery outcome. Delivery status comes from
 * the email provider and is as fresh as replication, typically seconds.
 *
 * @see Dodopayments\Services\Customers\EmailsService::list()
 *
 * @phpstan-type EmailListParamsShape = array{
 *   pageNumber?: int|null, pageSize?: int|null
 * }
 */
final class EmailListParams implements BaseModel
{
    /** @use SdkModel<EmailListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Which page to return. The default is 0.
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * How many emails to return. The default is 10 and the maximum is 100.
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
        ?int $pageNumber = null,
        ?int $pageSize = null
    ): self {
        $self = new self;

        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Which page to return. The default is 0.
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * How many emails to return. The default is 10 and the maximum is 100.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
