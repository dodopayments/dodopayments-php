<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\LicenseKey\PayloadType;

/**
 * @phpstan-type license_key_alias = array{payloadType: PayloadType::*}
 */
final class LicenseKey implements BaseModel
{
    use Model;

    /** @var PayloadType::* $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new LicenseKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKey::with(payloadType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKey)->withPayloadType(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PayloadType::* $payloadType
     */
    public static function with(string $payloadType): self
    {
        $obj = new self;

        $obj->payloadType = $payloadType;

        return $obj;
    }

    /**
     * @param PayloadType::* $payloadType
     */
    public function withPayloadType(string $payloadType): self
    {
        $obj = clone $this;
        $obj->payloadType = $payloadType;

        return $obj;
    }
}
