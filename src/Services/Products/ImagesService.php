<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\ImagesContract;

final class ImagesService implements ImagesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{forceUpdate?: bool}|ImageUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ImageUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): ImageUpdateResponse {
        [$parsed, $options] = ImageUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<ImageUpdateResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['products/%1$s/images', $id],
            query: Util::array_transform_keys(
                $parsed,
                ['forceUpdate' => 'force_update']
            ),
            options: $options,
            convert: ImageUpdateResponse::class,
        );

        return $response->parse();
    }
}
