<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Concerns\Params;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_files_params = array{fileName: string}
 */
final class ProductUpdateFilesParams implements BaseModel
{
    use Model;
    use Params;

    #[Api('file_name')]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $fileName): self
    {
        $obj = new self;

        $obj->fileName = $fileName;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }
}
