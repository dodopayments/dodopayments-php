<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\DigitalProductDelivery;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type file_alias = array{fileID: string, fileName: string, url: string}
 */
final class File implements BaseModel
{
    /** @use SdkModel<file_alias> */
    use SdkModel;

    #[Api('file_id')]
    public string $fileID;

    #[Api('file_name')]
    public string $fileName;

    #[Api]
    public string $url;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(fileID: ..., fileName: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new File)->withFileID(...)->withFileName(...)->withURL(...)
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
    public static function with(
        string $fileID,
        string $fileName,
        string $url
    ): self {
        $obj = new self;

        $obj->fileID = $fileID;
        $obj->fileName = $fileName;
        $obj->url = $url;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj->fileID = $fileID;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
