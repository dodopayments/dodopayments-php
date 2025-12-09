<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicenseKeysService::update()
 *
 * @phpstan-type LicenseKeyUpdateParamsShape = array{
 *   activationsLimit?: int|null,
 *   disabled?: bool|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyUpdateParams implements BaseModel
{
    /** @use SdkModel<LicenseKeyUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    #[Optional('activations_limit', nullable: true)]
    public ?int $activationsLimit;

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    #[Optional(nullable: true)]
    public ?bool $disabled;

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

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
        ?int $activationsLimit = null,
        ?bool $disabled = null,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $obj = new self;

        null !== $activationsLimit && $obj['activationsLimit'] = $activationsLimit;
        null !== $disabled && $obj['disabled'] = $disabled;
        null !== $expiresAt && $obj['expiresAt'] = $expiresAt;

        return $obj;
    }

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $obj = clone $this;
        $obj['activationsLimit'] = $activationsLimit;

        return $obj;
    }

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    public function withDisabled(?bool $disabled): self
    {
        $obj = clone $this;
        $obj['disabled'] = $disabled;

        return $obj;
    }

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj['expiresAt'] = $expiresAt;

        return $obj;
    }
}
