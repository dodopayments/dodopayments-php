<?php

declare(strict_types=1);

namespace DodoPayments\Customers\CustomerPortal;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type create_params = array{sendEmail?: bool}
 */
final class CustomerPortalCreateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * If true, will send link to user.
     */
    #[Api(optional: true)]
    public ?bool $sendEmail;

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
    public static function from(?bool $sendEmail = null): self
    {
        $obj = new self;

        null !== $sendEmail && $obj->sendEmail = $sendEmail;

        return $obj;
    }

    /**
     * If true, will send link to user.
     */
    public function setSendEmail(bool $sendEmail): self
    {
        $this->sendEmail = $sendEmail;

        return $this;
    }
}
