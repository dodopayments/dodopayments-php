<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomerPortalSessionShape = array{link: string}
 */
final class CustomerPortalSession implements BaseModel
{
    /** @use SdkModel<CustomerPortalSessionShape> */
    use SdkModel;

    #[Required]
    public string $link;

    /**
     * `new CustomerPortalSession()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomerPortalSession::with(link: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomerPortalSession)->withLink(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $link): self
    {
        $self = new self;

        $self['link'] = $link;

        return $self;
    }

    public function withLink(string $link): self
    {
        $self = clone $this;
        $self['link'] = $link;

        return $self;
    }
}
