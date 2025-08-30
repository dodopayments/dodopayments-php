<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Choose how you would like you digital product delivered.
 *
 * @phpstan-type digital_product_delivery = array{
 *   externalURL?: string|null, instructions?: string|null
 * }
 */
final class DigitalProductDelivery implements BaseModel
{
    /** @use SdkModel<digital_product_delivery> */
    use SdkModel;

    /**
     * External URL to digital product.
     */
    #[Api('external_url', nullable: true, optional: true)]
    public ?string $externalURL;

    /**
     * Instructions to download and use the digital product.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $instructions;

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
        ?string $externalURL = null,
        ?string $instructions = null
    ): self {
        $obj = new self;

        null !== $externalURL && $obj->externalURL = $externalURL;
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
     * Instructions to download and use the digital product.
     */
    public function withInstructions(?string $instructions): self
    {
        $obj = clone $this;
        $obj->instructions = $instructions;

        return $obj;
    }
}
