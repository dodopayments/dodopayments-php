<?php

declare(strict_types=1);

namespace Dodopayments\Contracts\Products;

use Dodopayments\RequestOptions;
use Dodopayments\Responses\Products\Images\ImageUpdateResponse;

interface ImagesContract
{
    /**
     * @param bool $forceUpdate
     */
    public function update(
        string $id,
        $forceUpdate = null,
        ?RequestOptions $requestOptions = null
    ): ImageUpdateResponse;
}
