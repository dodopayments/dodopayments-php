<?php

declare(strict_types=1);

namespace Dodopayments\Products;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Digital-product-delivery payload for a grant. Populated for grants whose
 * entitlement has `integration_type = 'digital_files'`. `files` carries
 * presigned download URLs; the source (EE service or legacy in-process S3
 * presigning) is opaque to the caller.
 *
 * @phpstan-import-type DigitalProductDeliveryFileShape from \Dodopayments\Products\DigitalProductDeliveryFile
 *
 * @phpstan-type DigitalProductDeliveryShape = array{
 *   files: list<DigitalProductDeliveryFile|DigitalProductDeliveryFileShape>,
 *   externalURL?: string|null,
 *   instructions?: string|null,
 * }
 */
final class DigitalProductDelivery implements BaseModel
{
    /** @use SdkModel<DigitalProductDeliveryShape> */
    use SdkModel;

    /** @var list<DigitalProductDeliveryFile> $files */
    #[Required(list: DigitalProductDeliveryFile::class)]
    public array $files;

    #[Optional('external_url', nullable: true)]
    public ?string $externalURL;

    #[Optional(nullable: true)]
    public ?string $instructions;

    /**
     * `new DigitalProductDelivery()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalProductDelivery::with(files: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalProductDelivery)->withFiles(...)
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
     *
     * @param list<DigitalProductDeliveryFile|DigitalProductDeliveryFileShape> $files
     */
    public static function with(
        array $files,
        ?string $externalURL = null,
        ?string $instructions = null
    ): self {
        $self = new self;

        $self['files'] = $files;

        null !== $externalURL && $self['externalURL'] = $externalURL;
        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param list<DigitalProductDeliveryFile|DigitalProductDeliveryFileShape> $files
     */
    public function withFiles(array $files): self
    {
        $self = clone $this;
        $self['files'] = $files;

        return $self;
    }

    public function withExternalURL(?string $externalURL): self
    {
        $self = clone $this;
        $self['externalURL'] = $externalURL;

        return $self;
    }

    public function withInstructions(?string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
