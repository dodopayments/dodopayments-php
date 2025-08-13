<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute\PayloadType;

/**
 * @phpstan-type dispute_alias = array{payloadType: PayloadType::*}
 */
final class Dispute implements BaseModel
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
