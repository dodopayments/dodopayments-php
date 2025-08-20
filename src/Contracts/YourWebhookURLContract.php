<?php

declare(strict_types=1);

namespace Dodopayments\Contracts;

use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

interface YourWebhookURLContract
{
    /**
     * @param string $businessID
     * @param Dispute|LicenseKey|Payment|Refund|Subscription $data The latest data at the time of delivery attempt
     * @param \DateTimeInterface $timestamp The timestamp of when the event occurred (not necessarily the same of when it was delivered)
     * @param WebhookEventType::* $type Event types for Dodo events
     * @param string $webhookID
     * @param string $webhookSignature
     * @param string $webhookTimestamp
     */
    public function create(
        $businessID,
        $data,
        $timestamp,
        $type,
        $webhookID,
        $webhookSignature,
        $webhookTimestamp,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
