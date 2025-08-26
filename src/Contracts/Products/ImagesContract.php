<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Products;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\Images\ImageUpdateResponse;

use const Dodopayments\Core\OMIT as omit;

interface ImagesContract
{
    /**
     * @param bool $forceUpdate
     */
    public function update(
        string $id,
        $forceUpdate = omit,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse;
}
