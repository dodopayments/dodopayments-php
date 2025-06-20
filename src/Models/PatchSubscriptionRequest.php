<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PatchSubscriptionRequest
{
    #[SerializedName('billing')]
    public ?BillingAddress $billing;

    #[SerializedName('cancel_at_next_billing_date')]
    public ?bool $cancelAtNextBillingDate;

    #[SerializedName('disable_on_demand')]
    public ?DisableOnDemandReq $disableOnDemand;

    #[SerializedName('metadata')]
    public ?array $metadata;

    #[SerializedName('status')]
    public ?SubscriptionStatus $status;

    #[SerializedName('tax_id')]
    public ?string $taxId;

    public function __construct(
        ?BillingAddress $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        ?DisableOnDemandReq $disableOnDemand = null,
        ?array $metadata = [],
        ?SubscriptionStatus $status = null,
        ?string $taxId = null
    ) {
        $this->billing = $billing;
        $this->cancelAtNextBillingDate = $cancelAtNextBillingDate;
        $this->disableOnDemand = $disableOnDemand;
        $this->metadata = $metadata;
        $this->status = $status;
        $this->taxId = $taxId;
    }
}
