<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts;

use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\WebhookEvents\WebhookEventType;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

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
