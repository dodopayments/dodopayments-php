<?php

declare(strict_types=1);

namespace DodoPayments\LicenseKeys;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_params = array{
 *   activationsLimit?: int|null,
 *   disabled?: bool|null,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class LicenseKeyUpdateParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * The updated activation limit for the license key.
     * Use `null` to remove the limit, or omit this field to leave it unchanged.
     */
    #[Api('activations_limit', optional: true)]
    public ?int $activationsLimit;

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    #[Api(optional: true)]
    public ?bool $disabled;

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    #[Api('expires_at', optional: true)]
    public ?\DateTimeInterface $expiresAt;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(
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
    public function setActivationsLimit(?int $activationsLimit): self
    {
        $this->activationsLimit = $activationsLimit;

        return $this;
    }

    /**
     * Indicates whether the license key should be disabled.
     * A value of `true` disables the key, while `false` enables it. Omit this field to leave it unchanged.
     */
    public function setDisabled(?bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * The updated expiration timestamp for the license key in UTC.
     * Use `null` to remove the expiration date, or omit this field to leave it unchanged.
     */
    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
