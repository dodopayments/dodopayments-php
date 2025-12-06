<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type ProductUpdateFilesResponseShape = array{
 *   file_id: string, url: string
 * }
 */
final class ProductUpdateFilesResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ProductUpdateFilesResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $file_id;

    #[Api]
    public string $url;

    /**
     * `new ProductUpdateFilesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductUpdateFilesResponse::with(file_id: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductUpdateFilesResponse)->withFileID(...)->withURL(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $file_id, string $url): self
    {
        $obj = new self;

        $obj['file_id'] = $file_id;
        $obj['url'] = $url;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['file_id'] = $fileID;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
