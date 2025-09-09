<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\Subscription\PayloadType;

/**
 * Response struct representing subscription details.
 *
 * @phpstan-type subscription_alias = array{payloadType: value-of<PayloadType>}
 */
final class Subscription implements BaseModel
{
    /** @use SdkModel<subscription_alias> */
    use SdkModel;

    /** @var value-of<PayloadType> $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new Subscription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Subscription::with(payloadType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Subscription)->withPayloadType(...)
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
     *
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public static function with(PayloadType|string $payloadType): self
    {
        $obj = new self;

        $obj->payloadType = $payloadType instanceof PayloadType ? $payloadType->value : $payloadType;

        return $obj;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $obj = clone $this;
        $obj->payloadType = $payloadType instanceof PayloadType ? $payloadType->value : $payloadType;

        return $obj;
    }
}
