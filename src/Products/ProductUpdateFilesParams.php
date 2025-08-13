<?php

declare(strict_types=1);

namespace DodoPayments\Products;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_files_params = array{fileName: string}
 */
final class ProductUpdateFilesParams implements BaseModel
{
    use Model;
    use Params;

    #[Api('file_name')]
    public string $fileName;

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
    public static function from(string $fileName): self
    {
        $obj = new self;

        $obj->fileName = $fileName;

        return $obj;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }
}
