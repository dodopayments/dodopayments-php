<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\ImagesContract;

use const Dodopayments\Core\OMIT as omit;

final class ImagesService implements ImagesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param bool $forceUpdate
     *
     * @return ImageUpdateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        $forceUpdate = omit,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse {
        $params = ['forceUpdate' => $forceUpdate];

        return $this->updateRaw($id, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return ImageUpdateResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function updateRaw(
        string $id,
        array $params,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse {
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            $params,
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
