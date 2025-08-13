<?php

declare(strict_types=1);

namespace DodopaymentsClient\Products\Images;

use DodopaymentsClient\Client;
use DodopaymentsClient\Contracts\Products\ImagesContract;
use DodopaymentsClient\Core\Conversion;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Products\Images\ImageUpdateResponse;

final class ImagesService implements ImagesContract
{
    public function __construct(private Client $client) {}

    /**
     * @param array{forceUpdate?: bool}|ImageUpdateParams $params
     */
    public function update(
        string $id,
        array|ImageUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): ImageUpdateResponse {
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            $params,
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
