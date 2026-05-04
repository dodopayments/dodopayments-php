<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Files;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileUploadResponseShape = array{fileID: string}
 */
final class FileUploadResponse implements BaseModel
{
    /** @use SdkModel<FileUploadResponseShape> */
    use SdkModel;

    /**
     * Identifier of the attached file. Pass it to
     * `DELETE /entitlements/{id}/files/{file_id}` to detach the file later.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * `new FileUploadResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileUploadResponse::with(fileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileUploadResponse)->withFileID(...)
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
    public static function with(string $fileID): self
    {
        $self = new self;

        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * Identifier of the attached file. Pass it to
     * `DELETE /entitlements/{id}/files/{file_id}` to detach the file later.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }
}
