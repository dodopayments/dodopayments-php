<?php

declare(strict_types=1);

namespace Dodopayments\YourWebhookURL;

use Dodopayments\Client;
use Dodopayments\Contracts\YourWebhookURLContract;
use Dodopayments\RequestOptions;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

final class YourWebhookURLService implements YourWebhookURLContract
{
    public function __construct(private Client $client) {}

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
    ): mixed {
        [$parsed, $options] = YourWebhookURLCreateParams::parseRequest(
            [
                'businessID' => $businessID,
                'data' => $data,
                'timestamp' => $timestamp,
                'type' => $type,
                'webhookID' => $webhookID,
                'webhookSignature' => $webhookSignature,
                'webhookTimestamp' => $webhookTimestamp,
            ],
            $requestOptions,
        );
        $header_params = [
            'webhook-id' => 'webhook-id',
            'webhook-signature' => 'webhook-signature',
            'webhook-timestamp' => 'webhook-timestamp',
        ];

        return $this->client->request(
            method: 'post',
            path: 'your-webhook-url',
            headers: array_intersect_key($parsed, array_keys($header_params)),
            body: (object) array_diff_key($parsed, array_keys($header_params)),
            options: $options,
        );
    }
}
