<?php

declare(strict_types=1);

namespace DodoPayments\YourWebhookURL;

use DodoPayments\Client;
use DodoPayments\Contracts\YourWebhookURLContract;
use DodoPayments\RequestOptions;
use DodoPayments\WebhookEvents\WebhookEventType;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

final class YourWebhookURLService implements YourWebhookURLContract
{
    public function __construct(private Client $client) {}

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
    ): mixed {
        [$parsed, $options] = YourWebhookURLCreateParams::parseRequest(
            $params,
            $requestOptions
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
