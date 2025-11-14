<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\Type;

/**
 * @see Dodopayments\Services\SubscriptionsService::updatePaymentMethod()
 *
 * @phpstan-type SubscriptionUpdatePaymentMethodParamsShape = array{
 *   type: Type|value-of<Type>, return_url?: string|null, payment_method_id: string
 * }
 */
final class SubscriptionUpdatePaymentMethodParams implements BaseModel
{
    /** @use SdkModel<SubscriptionUpdatePaymentMethodParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var value-of<Type> $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(nullable: true, optional: true)]
    public ?string $return_url;

    #[Api]
    public string $payment_method_id;

    /**
     * `new SubscriptionUpdatePaymentMethodParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionUpdatePaymentMethodParams::with(type: ..., payment_method_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionUpdatePaymentMethodParams)
     *   ->withType(...)
     *   ->withPaymentMethodID(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        Type|string $type,
        string $payment_method_id,
        ?string $return_url = null
    ): self {
        $obj = new self;

        $obj['type'] = $type;
        $obj->payment_method_id = $payment_method_id;

        null !== $return_url && $obj->return_url = $return_url;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    public function withReturnURL(?string $returnURL): self
    {
        $obj = clone $this;
        $obj->return_url = $returnURL;

        return $obj;
    }

    public function withPaymentMethodID(string $paymentMethodID): self
    {
        $obj = clone $this;
        $obj->payment_method_id = $paymentMethodID;

        return $obj;
    }
}
