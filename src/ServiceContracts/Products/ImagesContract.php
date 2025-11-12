<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;

interface ImagesContract
{
    /**
     * @api
     *
     * @param array<mixed>|ImageUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ImageUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): ImageUpdateResponse;
}
