<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductsService::updateFiles()
 *
 * @phpstan-type ProductUpdateFilesParamsShape = array{fileName: string}
 */
final class ProductUpdateFilesParams implements BaseModel
{
    /** @use SdkModel<ProductUpdateFilesParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('file_name')]
    public string $fileName;

    /**
     * `new ProductUpdateFilesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductUpdateFilesParams::with(fileName: ...)
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
    public static function with(string $fileName): self
    {
        $self = new self;

        $self['fileName'] = $fileName;

        return $self;
    }

    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }
}
