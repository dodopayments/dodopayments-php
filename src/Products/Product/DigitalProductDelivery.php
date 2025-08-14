<?php

declare(strict_types=1);

namespace Dodopayments\Products\Product;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\Products\Product\DigitalProductDelivery\File;

/**
 * @phpstan-type digital_product_delivery_alias = array{
 *   externalURL?: string|null, files?: list<File>|null, instructions?: string|null
 * }
 */
final class DigitalProductDelivery implements BaseModel
{
    use Model;

    /**
     * External URL to digital product.
     */
    #[Api('external_url', optional: true)]
    public ?string $externalURL;

    /**
     * Uploaded files ids of digital product.
     *
     * @var null|list<File> $files
     */
    #[Api(type: new ListOf(File::class), nullable: true, optional: true)]
    public ?array $files;

    /**
     * Instructions to download and use the digital product.
     */
    #[Api(optional: true)]
    public ?string $instructions;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<File> $files
     */
    public static function with(
        ?string $externalURL = null,
        ?array $files = null,
        ?string $instructions = null,
    ): self {
        $obj = new self;

        null !== $externalURL && $obj->externalURL = $externalURL;
        null !== $files && $obj->files = $files;
        null !== $instructions && $obj->instructions = $instructions;

        return $obj;
    }

    /**
     * External URL to digital product.
     */
    public function withExternalURL(?string $externalURL): self
    {
        $obj = clone $this;
        $obj->externalURL = $externalURL;

        return $obj;
    }

    /**
     * Uploaded files ids of digital product.
     *
     * @param null|list<File> $files
     */
    public function withFiles(?array $files): self
    {
        $obj = clone $this;
        $obj->files = $files;

        return $obj;
    }

    /**
     * Instructions to download and use the digital product.
     */
    public function withInstructions(?string $instructions): self
    {
        $obj = clone $this;
        $obj->instructions = $instructions;

        return $obj;
    }
}
