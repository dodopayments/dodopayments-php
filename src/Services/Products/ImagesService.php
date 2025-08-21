<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Contracts\Products\ImagesContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Products\Images\ImageUpdateParams;
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
        $args = ['forceUpdate' => $forceUpdate];
        $args = Util::array_filter_null($args, ['forceUpdate']);
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            $args,
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
