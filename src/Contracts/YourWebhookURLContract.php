<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

interface YourWebhookURLContract
{
    /**
     * @param array{
     *   businessID: string,
     *   data: Dispute|LicenseKey|Payment|Refund|Subscription,
     *   timestamp: \DateTimeInterface,
     *   type: WebhookEventType::*,
     *   webhookID: string,
     *   webhookSignature: string,
     *   webhookTimestamp: string,
     * }|YourWebhookURLCreateParams $params
     */
    public function create(
        array|YourWebhookURLCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
