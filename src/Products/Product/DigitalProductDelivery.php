<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Products\Product\DigitalProductDelivery\File;

/**
 * @phpstan-type DigitalProductDeliveryShape = array{
 *   externalURL?: string|null, files?: list<File>|null, instructions?: string|null
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
     * @var list<File>|null $files
     */
    #[Optional(list: File::class, nullable: true)]
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
     * @param list<File|array{
     *   fileID: string, fileName: string, url: string
     * }>|null $files
     */
    public static function with(
        ?string $externalURL = null,
        ?array $files = null,
        ?string $instructions = null,
    ): self {
        $obj = new self;

        null !== $externalURL && $obj['externalURL'] = $externalURL;
        null !== $files && $obj['files'] = $files;
        null !== $instructions && $obj['instructions'] = $instructions;

        return $obj;
    }

    /**
     * External URL to digital product.
     */
    public function withExternalURL(?string $externalURL): self
    {
        $obj = clone $this;
        $obj['externalURL'] = $externalURL;

        return $obj;
    }

    /**
     * Uploaded files ids of digital product.
     *
     * @param list<File|array{
     *   fileID: string, fileName: string, url: string
     * }>|null $files
     */
    public function withFiles(?array $files): self
    {
        $obj = clone $this;
        $obj['files'] = $files;

        return $obj;
    }

    /**
     * Instructions to download and use the digital product.
     */
    public function withInstructions(?string $instructions): self
    {
        $obj = clone $this;
        $obj['instructions'] = $instructions;

        return $obj;
    }
}
