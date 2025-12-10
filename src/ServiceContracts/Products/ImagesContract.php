<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Products\Images\ImageUpdateResponse;
use Dodopayments\RequestOptions;

interface ImagesContract
{
    /**
     * @api
     *
     * @param string $id Product Id
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?bool $forceUpdate = null,
        ?RequestOptions $requestOptions = null,
    ): ImageUpdateResponse;
}
