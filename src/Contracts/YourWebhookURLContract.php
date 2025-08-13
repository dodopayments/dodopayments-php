<?php

declare(strict_types=1);

namespace DodoPayments\Contracts;

use DodoPayments\RequestOptions;
use DodoPayments\WebhookEvents\WebhookEventType;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

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
