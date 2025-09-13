<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;

use const Dodopayments\Core\OMIT as omit;

interface ImagesContract
{
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
    ): ImageUpdateResponse;

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
    ): ImageUpdateResponse;
}
