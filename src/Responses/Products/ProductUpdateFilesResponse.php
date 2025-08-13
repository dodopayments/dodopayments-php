<?php

declare(strict_types=1);

namespace DodopaymentsClient\Responses\Products;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type product_update_files_response_alias = array{
 *   fileID: string, url: string
 * }
 */
final class ProductUpdateFilesResponse implements BaseModel
{
    use Model;

    #[Api('file_id')]
    public string $fileID;

    #[Api]
    public string $url;

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
    public static function from(string $fileID, string $url): self
    {
        $obj = new self;

        $obj->fileID = $fileID;
        $obj->url = $url;

        return $obj;
    }

    public function setFileID(string $fileID): self
    {
        $this->fileID = $fileID;

        return $this;
    }

    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
