<?php

declare(strict_types=1);

namespace Dodopayments\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\LicenseKeysService::update()
 *
 * @phpstan-type LicenseKeyUpdateParamsShape = array{
 *   activations_limit?: int|null,
 *   disabled?: bool|null,
 *   expires_at?: \DateTimeInterface|null,
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
    #[Api(nullable: true, optional: true)]
    public ?int $activations_limit;

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
    #[Api(nullable: true, optional: true)]
    public ?\DateTimeInterface $expires_at;

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
        ?int $activations_limit = null,
        ?bool $disabled = null,
        ?\DateTimeInterface $expires_at = null,
    ): self {
        $obj = new self;

        null !== $activations_limit && $obj->activations_limit = $activations_limit;
        null !== $disabled && $obj->disabled = $disabled;
        null !== $expires_at && $obj->expires_at = $expires_at;

        return $obj;
    }

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    public function withActivationsLimit(?int $activationsLimit): self
    {
        $obj = clone $this;
        $obj->activations_limit = $activationsLimit;

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
        $obj->expires_at = $expiresAt;

        return $obj;
    }
}
