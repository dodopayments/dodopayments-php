<?php

declare(strict_types=1);

namespace Dodopayments\Products\Images;

use Dodopayments\Client;
use Dodopayments\Contracts\Products\ImagesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\Images\ImageUpdateResponse;

final class ImagesService implements ImagesContract
{
    public function __construct(private Client $client) {}

    /**
     * @param bool $forceUpdate
     */
    public function update(
        string $id,
        $forceUpdate = null,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse {
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            ['forceUpdate' => $forceUpdate],
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'put',
            path: ['products/%1$s/images', $id],
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(ImageUpdateResponse::class, value: $resp);
    }
}
