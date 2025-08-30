<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerPortal;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Customers\CustomerPortal->create
 *
 * @phpstan-type customer_portal_create_params = array{sendEmail?: bool}
 */
final class CustomerPortalCreateParams implements BaseModel
{
    /** @use SdkModel<customer_portal_create_params> */
    use SdkModel;
    use SdkParams;

    /**
     * If true, will send link to user.
     */
    #[Api(optional: true)]
    public ?bool $sendEmail;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $sendEmail = null): self
    {
        $obj = new self;

        null !== $sendEmail && $obj->sendEmail = $sendEmail;

        return $obj;
    }

    /**
     * If true, will send link to user.
     */
    public function withSendEmail(bool $sendEmail): self
    {
        $obj = clone $this;
        $obj->sendEmail = $sendEmail;

        return $obj;
    }
}
