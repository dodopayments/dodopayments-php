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

use const Dodopayments\Core\OMIT as omit;

final class ImagesService implements ImagesContract
{
    public function __construct(private Client $client) {}

    /**
     * @param bool $forceUpdate
     */
    public function update(
        string $id,
        $forceUpdate = omit,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse {
        $args = Util::array_filter_omit(['forceUpdate' => $forceUpdate]);
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
