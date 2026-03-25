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
 * @phpstan-type CustomerPortalCreateParamsShape = array{
 *   returnURL?: string|null, sendEmail?: bool|null
 * }
 */
final class CustomerPortalCreateParams implements BaseModel
{
    /** @use SdkModel<CustomerPortalCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional return URL for this session. Overrides the business-level default.
     * This URL will be shown as a "Return to {business}" back button in the portal.
     */
    #[Optional]
    public ?string $returnURL;

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
    public static function with(
        ?string $returnURL = null,
        ?bool $sendEmail = null
    ): self {
        $self = new self;

        null !== $returnURL && $self['returnURL'] = $returnURL;
        null !== $sendEmail && $self['sendEmail'] = $sendEmail;

        return $self;
    }

    /**
     * Optional return URL for this session. Overrides the business-level default.
     * This URL will be shown as a "Return to {business}" back button in the portal.
     */
    public function withReturnURL(string $returnURL): self
    {
        $self = clone $this;
        $self['returnURL'] = $returnURL;

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
