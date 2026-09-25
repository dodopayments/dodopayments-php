<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Moderation\ModerationGetUsageResponse;
use Dodopayments\Moderation\ModerationScreenParams;
use Dodopayments\Moderation\ModerationScreenResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ModerationRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ModerationRawService implements ModerationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Shows how many billable screens you made and how close you are to your next charge.
     *
     * **Billing.** A billable screen is a live-mode screen that returns a verdict. Dodo Payments charges
     * $0.30 for each full block of 1000 billable screens and debits the fee from your balance.
     * Each full block is charged within one hour. Screens that do not fill a block stay unbilled
     * until they do. Errors and test-mode screens are free and are not counted.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ModerationGetUsageResponse>
     *
     * @throws APIException
     */
    public function retrieveUsage(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'moderation/usage',
            options: $requestOptions,
            convert: ModerationGetUsageResponse::class,
        );
    }

    /**
     * @api
     *
     * Screens text, an image, or both, and returns a verdict: `allow`, `flag` or `deny`. The API is
     * fail-closed: do not generate when you get no verdict.
     *
     * **Pricing.** Dodo Payments charges $0.30 per 1000 billable screens and debits the fee from your
     * balance. A billable screen is a live-mode screen that returns a verdict. Errors and test-mode
     * screens are free.
     *
     * **429.** Honour `Retry-After` and retry. A 429 is a throughput limit, not a verdict.
     *
     * **Test mode** returns mock verdicts and never calls the model. The default verdict is
     * `allow`. Put one of these strings in `text` to select another outcome: `dodo_mock_flag`
     * (`flag`), `dodo_mock_deny` (`deny`), `dodo_mock_overloaded` (429) or `dodo_mock_not_ready`
     * (503).
     *
     * @param array{
     *   image?: string|null, requestID?: string|null, text?: string|null
     * }|ModerationScreenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ModerationScreenResponse>
     *
     * @throws APIException
     */
    public function screen(
        array|ModerationScreenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ModerationScreenParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'moderation/screen',
            body: (object) $parsed,
            options: $options,
            convert: ModerationScreenResponse::class,
        );
    }
}
