<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductListResponse\Entitlement\IntegrationConfig;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type FigmaConfigShape = array{figmaFileID: string}
 */
final class FigmaConfig implements BaseModel
{
    /** @use SdkModel<FigmaConfigShape> */
    use SdkModel;

    #[Required('figma_file_id')]
    public string $figmaFileID;

    /**
     * `new FigmaConfig()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FigmaConfig::with(figmaFileID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FigmaConfig)->withFigmaFileID(...)
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
    public static function with(string $figmaFileID): self
    {
        $self = new self;

        $self['figmaFileID'] = $figmaFileID;

        return $self;
    }

    public function withFigmaFileID(string $figmaFileID): self
    {
        $self = clone $this;
        $self['figmaFileID'] = $figmaFileID;

        return $self;
    }
}
