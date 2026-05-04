<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\IntegrationConfig;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\TimeInterval;

/**
 * @phpstan-type LicenseKeyConfigShape = array{
 *   activationMessage?: string|null,
 *   activationsLimit?: int|null,
 *   durationCount?: int|null,
 *   durationInterval?: null|TimeInterval|value-of<TimeInterval>,
 * }
 */
final class LicenseKeyConfig implements BaseModel
{
    /** @use SdkModel<LicenseKeyConfigShape> */
    use SdkModel;

    /**
     * Optional message displayed when a customer activates the license
     * key (≤ 2500 characters).
     */
    #[Optional('activation_message', nullable: true)]
    public ?string $activationMessage;

    /**
     * Maximum activations allowed per issued license key. Omit for unlimited.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * Validity duration of issued license keys. Provide both
     * `duration_count` and `duration_interval` together for a fixed
     * duration; omit both for non-expiring keys.
     */
    #[Optional('duration_count', nullable: true)]
    public ?int $durationCount;

    /**
     * Unit of `duration_count`.
     *
     * @var value-of<TimeInterval>|null $durationInterval
     */
    #[Optional('duration_interval', enum: TimeInterval::class, nullable: true)]
    public ?string $durationInterval;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TimeInterval|value-of<TimeInterval>|null $durationInterval
     */
    public static function with(
        ?string $activationMessage = null,
        ?int $activationsLimit = null,
        ?int $durationCount = null,
        TimeInterval|string|null $durationInterval = null,
    ): self {
        $self = new self;

        null !== $activationMessage && $self['activationMessage'] = $activationMessage;
        null !== $activationsLimit && $self['activationsLimit'] = $activationsLimit;
        null !== $durationCount && $self['durationCount'] = $durationCount;
        null !== $durationInterval && $self['durationInterval'] = $durationInterval;

        return $self;
    }

    /**
     * Optional message displayed when a customer activates the license
     * key (≤ 2500 characters).
     */
    public function withActivationMessage(?string $activationMessage): self
    {
        $self = clone $this;
        $self['activationMessage'] = $activationMessage;

        return $self;
    }

    /**
     * Maximum activations allowed per issued license key. Omit for unlimited.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $self = clone $this;
        $self['activationsLimit'] = $activationsLimit;

        return $self;
    }

    /**
     * Validity duration of issued license keys. Provide both
     * `duration_count` and `duration_interval` together for a fixed
     * duration; omit both for non-expiring keys.
     */
    public function withDurationCount(?int $durationCount): self
    {
        $self = clone $this;
        $self['durationCount'] = $durationCount;

        return $self;
    }

    /**
     * Unit of `duration_count`.
     *
     * @param TimeInterval|value-of<TimeInterval>|null $durationInterval
     */
    public function withDurationInterval(
        TimeInterval|string|null $durationInterval
    ): self {
        $self = clone $this;
        $self['durationInterval'] = $durationInterval;

        return $self;
    }
}
