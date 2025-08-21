<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute\PayloadType;

/**
 * @phpstan-type dispute_alias = array{payloadType: PayloadType::*}
 */
final class Dispute implements BaseModel
{
    use SdkModel;

    /** @var PayloadType::* $payloadType */
    #[Api('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /**
     * `new Dispute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Dispute::with(payloadType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Dispute)->withPayloadType(...)
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
