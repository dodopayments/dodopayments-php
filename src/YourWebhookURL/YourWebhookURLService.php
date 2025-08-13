<?php

declare(strict_types=1);

namespace DodopaymentsClient\YourWebhookURL;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\YourWebhookURLContract;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\WebhookEvents\WebhookEventType;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use DodopaymentsClient\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

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
