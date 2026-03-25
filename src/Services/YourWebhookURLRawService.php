<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\YourWebhookURLRawContract;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams;

/**
 * @phpstan-import-type DataShape from \Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class YourWebhookURLRawService implements YourWebhookURLRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   businessID: string,
     *   data: DataShape,
     *   timestamp: \DateTimeInterface,
     *   type: value-of<WebhookEventType>,
     *   webhookID: string,
     *   webhookSignature: string,
     *   webhookTimestamp: string,
     * }|YourWebhookURLCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function create(
        array|YourWebhookURLCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = YourWebhookURLCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'webhookID' => 'webhook-id',
            'webhookSignature' => 'webhook-signature',
            'webhookTimestamp' => 'webhook-timestamp',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'your-webhook-url',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: null,
        );
    }
}
