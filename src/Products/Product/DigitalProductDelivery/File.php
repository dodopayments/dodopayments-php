<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\DigitalProductDelivery;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{file_id: string, file_name: string, url: string}
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    #[Api]
    public string $file_id;

    #[Api]
    public string $file_name;

    #[Api]
    public string $url;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(file_id: ..., file_name: ..., url: ...)
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $file_id,
        string $file_name,
        string $url
    ): self {
        $obj = new self;

        $obj['file_id'] = $file_id;
        $obj['file_name'] = $file_name;
        $obj['url'] = $url;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['file_id'] = $fileID;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj['file_name'] = $fileName;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
