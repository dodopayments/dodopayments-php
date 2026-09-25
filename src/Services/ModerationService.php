<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Moderation\ModerationGetUsageResponse;
use Dodopayments\Moderation\ModerationScreenResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ModerationContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ModerationService implements ModerationContract
{
    /**
     * @api
     */
    public ModerationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ModerationRawService($client);
    }

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
     * @throws APIException
     */
    public function retrieveUsage(
        RequestOptions|array|null $requestOptions = null
    ): ModerationGetUsageResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveUsage(requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string|null $image The image to screen, as base64, with or without a `data:image/...;base64,` prefix. The
     * formats are JPEG, PNG, WebP, GIF and BMP. The limit is 6991530 base64 characters, and the
     * decoded image must be at most 5 MiB.
     * @param string|null $requestID Your identifier for this screen, up to 128 characters, with no control characters. The
     * response returns it in `request_id`.
     * @param string|null $text the text to screen, up to 8000 characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function screen(
        ?string $image = null,
        ?string $requestID = null,
        ?string $text = null,
        RequestOptions|array|null $requestOptions = null,
    ): ModerationScreenResponse {
        $params = Util::removeNulls(
            ['image' => $image, 'requestID' => $requestID, 'text' => $text]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->screen(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
