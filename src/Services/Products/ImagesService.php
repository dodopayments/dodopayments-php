<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\ImagesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ImagesService implements ImagesContract
{
    /**
     * @api
     */
    public ImagesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ImagesRawService($client);
    }

    /**
     * @api
     *
     * @param string $id Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?bool $forceUpdate = null,
        RequestOptions|array|null $requestOptions = null,
    ): ImageUpdateResponse {
        $params = Util::removeNulls(['forceUpdate' => $forceUpdate]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
