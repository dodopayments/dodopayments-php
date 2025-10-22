<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\LicenseKeys->update
 *
 * @phpstan-type license_key_update_params = array{
 *   activationsLimit?: int|null,
 *   disabled?: bool|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyUpdateParams implements BaseModel
{
    /** @use SdkModel<license_key_update_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    #[Api('activations_limit', nullable: true, optional: true)]
    public ?int $activationsLimit;

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    #[Api(nullable: true, optional: true)]
    public ?bool $disabled;

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    #[Api('expires_at', nullable: true, optional: true)]
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

        null !== $activationsLimit && $obj->activationsLimit = $activationsLimit;
        null !== $disabled && $obj->disabled = $disabled;
        null !== $expiresAt && $obj->expiresAt = $expiresAt;

        return $obj;
    }

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $obj = clone $this;
        $obj->activationsLimit = $activationsLimit;

        return $obj;
    }

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    public function withDisabled(?bool $disabled): self
    {
        $obj = clone $this;
        $obj->disabled = $disabled;

        return $obj;
    }

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $obj = clone $this;
        $obj->expiresAt = $expiresAt;

        return $obj;
    }
}
