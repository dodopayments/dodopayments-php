<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\YourWebhookURLContract;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditBalanceLow;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\CreditLedgerEntry;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Dispute;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\LicenseKey;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Refund;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Subscription;

/**
 * @phpstan-import-type DataShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class YourWebhookURLService implements YourWebhookURLContract
{
    /**
     * @api
     */
    public YourWebhookURLRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new YourWebhookURLRawService($client);
    }

    /**
     * @api
     *
     * @param string $businessID Body param
     * @param DataShape $data Body param: The latest data at the time of delivery attempt
     * @param \DateTimeInterface $timestamp Body param: The timestamp of when the event occurred (not necessarily the same of when it was delivered)
     * @param WebhookEventType|value-of<WebhookEventType> $type Body param: Event types for Dodo events
     * @param string $webhookID Header param: Unique identifier for the webhook
     * @param string $webhookSignature Header param: Signature of the Webhook
     * @param string $webhookTimestamp Header param: Unix timestamp when the webhook was sent
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $businessID,
        Payment|array|Subscription|Refund|Dispute|LicenseKey|CreditLedgerEntry|CreditBalanceLow $data,
        \DateTimeInterface $timestamp,
        WebhookEventType|string $type,
        string $webhookID,
        string $webhookSignature,
        string $webhookTimestamp,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'businessID' => $businessID,
                'data' => $data,
                'timestamp' => $timestamp,
                'type' => $type,
                'webhookID' => $webhookID,
                'webhookSignature' => $webhookSignature,
                'webhookTimestamp' => $webhookTimestamp,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
