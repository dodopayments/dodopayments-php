<?php

declare(strict_types=1);

namespace DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription\PayloadType;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type subscription_alias = array{payloadType: PayloadType::*}
 */
final class Subscription implements BaseModel
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
