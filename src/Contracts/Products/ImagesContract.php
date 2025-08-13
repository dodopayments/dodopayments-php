<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Products;

use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\Images\ImageUpdateResponse;

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
