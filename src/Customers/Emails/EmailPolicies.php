<?php

declare(strict_types=1);

namespace Dodopayments\Customers\Emails;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * What the merchant may do with one row. The server decides; the client never
 * derives eligibility itself.
 *
 * @phpstan-type EmailPoliciesShape = array{
 *   requiresDifferentAddress: bool,
 *   resendAllowed: bool,
 *   resendsRemaining: int,
 *   retryAllowed: bool,
 * }
 */
final class EmailPolicies implements BaseModel
{
    /** @use SdkModel<EmailPoliciesShape> */
    use SdkModel;

    /**
     * A permanent failure was recorded, so the same address would be a no-op.
     */
    #[Required('requires_different_address')]
    public bool $requiresDifferentAddress;

    /**
     * The row was delivered and may be sent again.
     */
    #[Required('resend_allowed')]
    public bool $resendAllowed;

    /**
     * How many sends are left in this email's chain.
     */
    #[Required('resends_remaining')]
    public int $resendsRemaining;

    /**
     * The row failed and may be sent again.
     */
    #[Required('retry_allowed')]
    public bool $retryAllowed;

    /**
     * `new EmailPolicies()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmailPolicies::with(
     *   requiresDifferentAddress: ...,
     *   resendAllowed: ...,
     *   resendsRemaining: ...,
     *   retryAllowed: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmailPolicies)
     *   ->withRequiresDifferentAddress(...)
     *   ->withResendAllowed(...)
     *   ->withResendsRemaining(...)
     *   ->withRetryAllowed(...)
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
    public static function with(
        bool $requiresDifferentAddress,
        bool $resendAllowed,
        int $resendsRemaining,
        bool $retryAllowed,
    ): self {
        $self = new self;

        $self['requiresDifferentAddress'] = $requiresDifferentAddress;
        $self['resendAllowed'] = $resendAllowed;
        $self['resendsRemaining'] = $resendsRemaining;
        $self['retryAllowed'] = $retryAllowed;

        return $self;
    }

    /**
     * A permanent failure was recorded, so the same address would be a no-op.
     */
    public function withRequiresDifferentAddress(
        bool $requiresDifferentAddress
    ): self {
        $self = clone $this;
        $self['requiresDifferentAddress'] = $requiresDifferentAddress;

        return $self;
    }

    /**
     * The row was delivered and may be sent again.
     */
    public function withResendAllowed(bool $resendAllowed): self
    {
        $self = clone $this;
        $self['resendAllowed'] = $resendAllowed;

        return $self;
    }

    /**
     * How many sends are left in this email's chain.
     */
    public function withResendsRemaining(int $resendsRemaining): self
    {
        $self = clone $this;
        $self['resendsRemaining'] = $resendsRemaining;

        return $self;
    }

    /**
     * The row failed and may be sent again.
     */
    public function withRetryAllowed(bool $retryAllowed): self
    {
        $self = clone $this;
        $self['retryAllowed'] = $retryAllowed;

        return $self;
    }
}
