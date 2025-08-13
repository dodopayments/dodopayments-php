<?php

declare(strict_types=1);

namespace DodoPayments\Products\Product\DigitalProductDelivery;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type file_alias = array{fileID: string, fileName: string, url: string}
 */
final class File implements BaseModel
{
    use Model;

    #[Api('file_id')]
    public string $fileID;

    #[Api('file_name')]
    public string $fileName;

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
    public static function from(
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

    public function setFileID(string $fileID): self
    {
        $this->fileID = $fileID;

        return $this;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
