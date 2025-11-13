<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductsService::updateFiles()
 *
 * @phpstan-type ProductUpdateFilesParamsShape = array{file_name: string}
 */
final class ProductUpdateFilesParams implements BaseModel
{
    /** @use SdkModel<ProductUpdateFilesParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $file_name;

    /**
     * `new ProductUpdateFilesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductUpdateFilesParams::with(file_name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductUpdateFilesParams)->withFileName(...)
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
    public static function with(string $file_name): self
    {
        $obj = new self;

        $obj->file_name = $file_name;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->file_name = $fileName;

        return $obj;
    }
}
