<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Products\Images\ImageUpdateParams;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;

interface ImagesRawContract
{
    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<string,mixed>|ImageUpdateParams $params
     *
     * @return BaseResponse<ImageUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ImageUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
