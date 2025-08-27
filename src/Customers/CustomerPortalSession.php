<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type customer_portal_session = array{link: string}
 */
final class CustomerPortalSession implements BaseModel
{
    /** @use SdkModel<customer_portal_session> */
    use SdkModel;

    #[Api]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $link): self
    {
        $obj = new self;

        $obj->link = $link;

        return $obj;
    }

    public function withLink(string $link): self
    {
        $obj = clone $this;
        $obj->link = $link;

        return $obj;
    }
}
