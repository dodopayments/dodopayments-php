<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductUpdateFilesResponseShape = array{
 *   fileID: string, url: string
 * }
 */
final class ProductUpdateFilesResponse implements BaseModel
{
    /** @use SdkModel<ProductUpdateFilesResponseShape> */
    use SdkModel;

    #[Required('file_id')]
    public string $fileID;

    #[Required]
    public string $url;

    /**
     * `new ProductUpdateFilesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductUpdateFilesResponse::with(fileID: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductUpdateFilesResponse)->withFileID(...)->withURL(...)
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
    public static function with(string $fileID, string $url): self
    {
        $self = new self;

        $self['fileID'] = $fileID;
        $self['url'] = $url;

        return $self;
    }

    public function withFileID(string $fileID): self
    {
        $self = clone $this;
        $self['fileID'] = $fileID;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
