<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * One file in a digital-product delivery payload.
 *
 * @phpstan-type DigitalProductDeliveryFileShape = array{
 *   downloadURL: string,
 *   expiresIn: int,
 *   fileID: string,
 *   filename: string,
 *   contentType?: string|null,
 *   fileSize?: int|null,
 * }
 */
final class DigitalProductDeliveryFile implements BaseModel
{
    /** @use SdkModel<DigitalProductDeliveryFileShape> */
    use SdkModel;

    /**
     * Short-lived presigned URL for downloading the file.
     */
    #[Required('download_url')]
    public string $downloadURL;

    /**
     * Seconds until `download_url` expires.
     */
    #[Required('expires_in')]
    public int $expiresIn;

    /**
     * Identifier of the attached file.
     */
    #[Required('file_id')]
    public string $fileID;

    /**
     * Original filename of the attached file.
     */
    #[Required]
    public string $filename;

    /**
     * Optional content-type declared at upload.
     */
    #[Optional('content_type', nullable: true)]
    public ?string $contentType;

    /**
     * Optional size of the file in bytes.
     */
    #[Optional('file_size', nullable: true)]
    public ?int $fileSize;

    /**
     * `new DigitalProductDeliveryFile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalProductDeliveryFile::with(
     *   downloadURL: ..., expiresIn: ..., fileID: ..., filename: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalProductDeliveryFile)
     *   ->withDownloadURL(...)
     *   ->withExpiresIn(...)
     *   ->withFileID(...)
     *   ->withFilename(...)
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
        ?string $contentType = null,
        ?int $fileSize = null,
    ): self {
        $self = new self;

        $self['downloadURL'] = $downloadURL;
        $self['expiresIn'] = $expiresIn;
        $self['fileID'] = $fileID;
        $self['filename'] = $filename;

        null !== $contentType && $self['contentType'] = $contentType;
        null !== $fileSize && $self['fileSize'] = $fileSize;

        return $self;
    }

    /**
     * Short-lived presigned URL for downloading the file.
     */
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

    /**
     * Identifier of the attached file.
     */
    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    /**
     * Original filename of the attached file.
     */
    public function withFilename(string $filename): self
    {
        $self = clone $this;
        $self['filename'] = $filename;

        return $self;
    }

    /**
     * Optional content-type declared at upload.
     */
    public function withContentType(?string $contentType): self
    {
        $self = clone $this;
        $self['contentType'] = $contentType;

        return $self;
    }

    /**
     * Optional size of the file in bytes.
     */
    public function withFileSize(?int $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }
}
