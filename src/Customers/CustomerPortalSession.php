<?php

declare(strict_types=1);

namespace Dodopayments\Customers;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type customer_portal_session_alias = array{link: string}
 */
final class CustomerPortalSession implements BaseModel
{
    use Model;

    #[Api]
    public string $link;

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
    public static function from(string $link): self
    {
        $obj = new self;

        $obj->link = $link;

        return $obj;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
