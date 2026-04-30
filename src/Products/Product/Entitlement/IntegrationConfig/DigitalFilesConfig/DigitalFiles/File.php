<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product\Entitlement\IntegrationConfig\DigitalFilesConfig\DigitalFiles;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileShape = array{
 *   downloadURL: string,
 *   expiresIn: int,
 *   fileID: string,
 *   filename: string,
 *   source: string,
 *   contentType?: string|null,
 *   fileSize?: int|null,
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    #[Required('download_url')]
    public string $downloadURL;

    /**
     * Seconds until `download_url` expires.
     */
    #[Required('expires_in')]
    public int $expiresIn;

    #[Required('file_id')]
    public string $fileID;

    #[Required]
    public string $filename;

    /**
     * `"legacy"` for files in `product_files`, `"ee"` for files managed by the
     * Entitlements Engine.
     */
    #[Required]
    public string $source;

    #[Optional('content_type', nullable: true)]
    public ?string $contentType;

    #[Optional('file_size', nullable: true)]
    public ?int $fileSize;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(
     *   downloadURL: ..., expiresIn: ..., fileID: ..., filename: ..., source: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new File)
     *   ->withDownloadURL(...)
     *   ->withExpiresIn(...)
     *   ->withFileID(...)
     *   ->withFilename(...)
     *   ->withSource(...)
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
        string $downloadURL,
        int $expiresIn,
        string $fileID,
        string $filename,
        string $source,
        ?string $contentType = null,
        ?int $fileSize = null,
    ): self {
        $self = new self;

        $self['downloadURL'] = $downloadURL;
        $self['expiresIn'] = $expiresIn;
        $self['fileID'] = $fileID;
        $self['filename'] = $filename;
        $self['source'] = $source;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $fileSize && $self['fileSize'] = $fileSize;

        return $self;
    }

    public function withDownloadURL(string $downloadURL): self
    {
        $self = clone $this;
        $self['downloadURL'] = $downloadURL;

        return $self;
    }

    /**
     * Seconds until `download_url` expires.
     */
    public function withExpiresIn(int $expiresIn): self
    {
        $self = clone $this;
        $self['expiresIn'] = $expiresIn;

        return $self;
    }

    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * `"legacy"` for files in `product_files`, `"ee"` for files managed by the
     * Entitlements Engine.
     */
    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    public function withContentType(?string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    public function withFileSize(?int $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }
}
