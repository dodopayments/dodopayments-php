<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerPortal;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Customers\CustomerPortalService::create()
 *
 * @phpstan-type CustomerPortalCreateParamsShape = array{send_email?: bool}
 */
final class CustomerPortalCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerPortalCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If true, will send link to user.
     */
    #[Api(optional: true)]
    public ?bool $send_email;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $send_email = null): self
    {
        $obj = new self;

        null !== $send_email && $obj['send_email'] = $send_email;

        return $obj;
    }

    /**
     * If true, will send link to user.
     */
    public function withSendEmail(bool $sendEmail): self
    {
        $obj = clone $this;
        $obj['send_email'] = $sendEmail;

        return $obj;
    }
}
