<?php

// This file was generated by liblab | https://liblab.com/

namespace Dodopayments\Models;

use Symfony\Component\Serializer\Annotation\SerializedName;

class PatchSubscriptionRequest
{
    #[SerializedName('metadata')]
    public ?array $metadata;

    #[SerializedName('status')]
    public ?SubscriptionStatus $status;

    public function __construct(?array $metadata = [], ?SubscriptionStatus $status = null)
    {
        $this->metadata = $metadata;
        $this->status = $status;
    }
}
