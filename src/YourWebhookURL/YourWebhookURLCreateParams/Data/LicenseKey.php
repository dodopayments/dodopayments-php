<?php

declare(strict_types=1);

namespace DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey\PayloadType;

/**
 * @phpstan-type license_key_alias = array{payloadType: PayloadType::*}
 */
final class LicenseKey implements BaseModel
{
    use Model;

    /** @var PayloadType::* $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

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
    public static function from(string $payloadType): self
    {
        $obj = new self;

        $obj->payloadType = $payloadType;

        return $obj;
    }

    /**
     * @param PayloadType::* $payloadType
     */
    public function setPayloadType(string $payloadType): self
    {
        $this->payloadType = $payloadType;

        return $this;
    }
}
