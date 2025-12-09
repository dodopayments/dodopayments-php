<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\DigitalProductDelivery;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{fileID: string, fileName: string, url: string}
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    #[Required('file_id')]
    public string $fileID;

    #[Required('file_name')]
    public string $fileName;

    #[Required]
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
        $this->initialize();
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

        $obj['fileID'] = $fileID;
        $obj['fileName'] = $fileName;
        $obj['url'] = $url;

        return $obj;
    }

    public function withFileID(string $fileID): self
    {
        $obj = clone $this;
        $obj['fileID'] = $fileID;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj['fileName'] = $fileName;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
