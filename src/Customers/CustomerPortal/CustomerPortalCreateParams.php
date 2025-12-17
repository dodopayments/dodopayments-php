<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerPortal;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Customers\CustomerPortalService::create()
 *
 * @phpstan-type CustomerPortalCreateParamsShape = array{sendEmail?: bool|null}
 */
final class CustomerPortalCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerPortalCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If true, will send link to user.
     */
    #[Optional]
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
        $self = new self;

        null !== $sendEmail && $self['sendEmail'] = $sendEmail;

        return $self;
    }

    /**
     * If true, will send link to user.
     */
    public function withSendEmail(bool $sendEmail): self
    {
        $self = clone $this;
        $self['sendEmail'] = $sendEmail;

        return $self;
    }
}
