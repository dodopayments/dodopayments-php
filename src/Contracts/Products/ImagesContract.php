<?php

declare(strict_types=1);

namespace DodopaymentsClient\Contracts\Products;

use DodopaymentsClient\Products\Images\ImageUpdateParams;
use DodopaymentsClient\RequestOptions;
use DodopaymentsClient\Responses\Products\Images\ImageUpdateResponse;

interface ImagesContract
{
    /**
     * @param array{forceUpdate?: bool}|ImageUpdateParams $params
     */
    public function update(
        string $id,
        array|ImageUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): ImageUpdateResponse;
}
