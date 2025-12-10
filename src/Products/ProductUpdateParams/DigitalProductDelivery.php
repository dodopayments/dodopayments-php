<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductUpdateParams;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Choose how you would like you digital product delivered.
 *
 * @phpstan-type DigitalProductDeliveryShape = array{
 *   externalURL?: string|null,
 *   files?: list<string>|null,
 *   instructions?: string|null,
 * }
 */
final class DigitalProductDelivery implements BaseModel
{
    /** @use SdkModel<DigitalProductDeliveryShape> */
    use SdkModel;

    /**
     * External URL to digital product.
     */
    #[Optional('external_url', nullable: true)]
    public ?string $externalURL;

    /**
     * Uploaded files ids of digital product.
     *
     * @var list<string>|null $files
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $files;

    /**
     * Instructions to download and use the digital product.
     */
    #[Optional(nullable: true)]
    public ?string $instructions;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $files
     */
    public static function with(
        ?string $externalURL = null,
        ?array $files = null,
        ?string $instructions = null,
    ): self {
        $self = new self;

        null !== $externalURL && $self['externalURL'] = $externalURL;
        null !== $files && $self['files'] = $files;
        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * External URL to digital product.
     */
    public function withExternalURL(?string $externalURL): self
    {
        $self = clone $this;
        $self['externalURL'] = $externalURL;

        return $self;
    }

    /**
     * Uploaded files ids of digital product.
     *
     * @param list<string>|null $files
     */
    public function withFiles(?array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    /**
     * Instructions to download and use the digital product.
     */
    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
