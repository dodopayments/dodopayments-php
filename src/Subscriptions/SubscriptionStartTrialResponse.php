<?php

declare(strict_types=1);

namespace Dodopayments\Subscriptions;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionStartTrialResponseShape = array{
 *   invoiceID: string, subscriptionID: string, trialEndsAt: \DateTimeInterface
 * }
 */
final class SubscriptionStartTrialResponse implements BaseModel
{
    /** @use SdkModel<SubscriptionStartTrialResponseShape> */
    use SdkModel;

    /**
     * The paid $0 invoice of the trial.
     */
    #[Required('invoice_id')]
    public string $invoiceID;

    #[Required('subscription_id')]
    public string $subscriptionID;

    /**
     * The first invoice after the trial bills at this time.
     */
    #[Required('trial_ends_at')]
    public \DateTimeInterface $trialEndsAt;

    /**
     * `new SubscriptionStartTrialResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionStartTrialResponse::with(
     *   invoiceID: ..., subscriptionID: ..., trialEndsAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionStartTrialResponse)
     *   ->withInvoiceID(...)
     *   ->withSubscriptionID(...)
     *   ->withTrialEndsAt(...)
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
     */
    public static function with(
        string $invoiceID,
        string $subscriptionID,
        \DateTimeInterface $trialEndsAt
    ): self {
        $self = new self;

        $self['invoiceID'] = $invoiceID;
        $self['subscriptionID'] = $subscriptionID;
        $self['trialEndsAt'] = $trialEndsAt;

        return $self;
    }

    /**
     * The paid $0 invoice of the trial.
     */
    public function withInvoiceID(string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    public function withSubscriptionID(string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * The first invoice after the trial bills at this time.
     */
    public function withTrialEndsAt(\DateTimeInterface $trialEndsAt): self
    {
        $self = clone $this;
        $self['trialEndsAt'] = $trialEndsAt;

        return $self;
    }
}
