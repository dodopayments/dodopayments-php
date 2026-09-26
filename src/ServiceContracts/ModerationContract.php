<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Moderation\ModerationGetUsageResponse;
use Dodopayments\Moderation\ModerationScreenResponse;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface ModerationContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveUsage(
        RequestOptions|array|null $requestOptions = null
    ): ModerationGetUsageResponse;

    /**
     * @api
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
    ): ModerationScreenResponse;
}
