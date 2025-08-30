<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type product_update_files_response = array{fileID: string, url: string}
 */
final class ProductUpdateFilesResponse implements BaseModel
{
    /** @use SdkModel<product_update_files_response> */
    use SdkModel;

    #[Api('file_id')]
    public string $fileID;

    #[Api]
    public string $url;

    /**
     * `new ProductUpdateFilesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductUpdateFilesResponse::with(fileID: ..., url: ...)
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
    public static function with(string $fileID, string $url): self
    {
        $obj = new self;

        $obj->fileID = $fileID;
        $obj->url = $url;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
