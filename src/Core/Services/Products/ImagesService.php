<?php

declare(strict_types=1);

namespace Dodopayments\Core\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\ServiceContracts\Products\ImagesContract;
use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;

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
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            ['forceUpdate' => $forceUpdate],
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['products/%1$s/images', $id],
            query: $parsed,
            options: $options,
            convert: ImageUpdateResponse::class,
        );
    }
}
