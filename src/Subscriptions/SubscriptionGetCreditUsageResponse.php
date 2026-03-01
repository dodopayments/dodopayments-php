<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Subscriptions\SubscriptionGetCreditUsageResponse\Item;

/**
 * Credit usage status for all entitlements linked to a subscription.
 *
 * @phpstan-import-type ItemShape from \Dodopayments\Subscriptions\SubscriptionGetCreditUsageResponse\Item
 *
 * @phpstan-type SubscriptionGetCreditUsageResponseShape = array{
 *   items: list<Item|ItemShape>, subscriptionID: string
 * }
 */
final class SubscriptionGetCreditUsageResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionGetCreditUsageResponseShape> */
    use SdkModel;

    /** @var list<Item> $items */
    #[Required(list: Item::class)]
    public array $items;

    #[Required('subscription_id')]
    public string $subscriptionID;

    /**
     * `new SubscriptionGetCreditUsageResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionGetCreditUsageResponse::with(items: ..., subscriptionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionGetCreditUsageResponse)
     *   ->withItems(...)
     *   ->withSubscriptionID(...)
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
     * @param list<Item|ItemShape> $items
     */
    public static function with(array $items, string $subscriptionID): self
    {
        $self = new self;

        $self['items'] = $items;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
