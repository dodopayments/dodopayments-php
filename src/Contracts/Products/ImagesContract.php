<?php

declare(strict_types=1);

namespace DodoPayments\Contracts\Products;

use DodoPayments\Products\Images\ImageUpdateParams;
use DodoPayments\RequestOptions;
use DodoPayments\Responses\Products\Images\ImageUpdateResponse;

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
