<?php

declare(strict_types=1);

namespace Dodopayments\Payments;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ManualRetryStateShape = array{
 *   canRetry: bool,
 *   sendsAllowed: int,
 *   sendsUsed: int,
 *   reason?: string|null,
 *   retryAvailableAt?: \DateTimeInterface|null,
 * }
 */
final class ManualRetryState implements BaseModel
{
    /** @use SdkModel<ManualRetryStateShape> */
    use SdkModel;

    #[Required('can_retry')]
    public bool $canRetry;

    #[Required('sends_allowed')]
    public int $sendsAllowed;

    #[Required('sends_used')]
    public int $sendsUsed;

    /**
     * The code `POST` would fail with. Null when `can_retry` is true.
     */
    #[Optional(nullable: true)]
    public ?string $reason;

    /**
     * When the next send becomes available. Null when no send is left, or when
     * the block has nothing to do with the cooldown.
     */
    #[Optional('retry_available_at', nullable: true)]
    public ?\DateTimeInterface $retryAvailableAt;

    /**
     * `new ManualRetryState()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ManualRetryState::with(canRetry: ..., sendsAllowed: ..., sendsUsed: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ManualRetryState)
     *   ->withCanRetry(...)
     *   ->withSendsAllowed(...)
     *   ->withSendsUsed(...)
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
        bool $canRetry,
        int $sendsAllowed,
        int $sendsUsed,
        ?string $reason = null,
        ?\DateTimeInterface $retryAvailableAt = null,
    ): self {
        $self = new self;

        $self['canRetry'] = $canRetry;
        $self['sendsAllowed'] = $sendsAllowed;
        $self['sendsUsed'] = $sendsUsed;

        null !== $reason && $self['reason'] = $reason;
        null !== $retryAvailableAt && $self['retryAvailableAt'] = $retryAvailableAt;

        return $self;
    }

    public function withCanRetry(bool $canRetry): self
    {
        $self = clone $this;
        $self['canRetry'] = $canRetry;

        return $self;
    }

    public function withSendsAllowed(int $sendsAllowed): self
    {
        $self = clone $this;
        $self['sendsAllowed'] = $sendsAllowed;

        return $self;
    }

    public function withSendsUsed(int $sendsUsed): self
    {
        $self = clone $this;
        $self['sendsUsed'] = $sendsUsed;

        return $self;
    }

    /**
     * The code `POST` would fail with. Null when `can_retry` is true.
     */
    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * When the next send becomes available. Null when no send is left, or when
     * the block has nothing to do with the cooldown.
     */
    public function withRetryAvailableAt(
        ?\DateTimeInterface $retryAvailableAt
    ): self {
        $self = clone $this;
        $self['retryAvailableAt'] = $retryAvailableAt;

        return $self;
    }
}
