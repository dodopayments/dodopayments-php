<?php

declare(strict_types=1);

namespace Dodopayments\Products\ProductCreateParams;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Choose how you would like you digital product delivered.
 *
 * @phpstan-type digital_product_delivery_alias = array{
 *   externalURL?: string|null, instructions?: string|null
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
     */
    public static function from(
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
    public function setExternalURL(?string $externalURL): self
    {
        $this->externalURL = $externalURL;

        return $this;
    }

    /**
     * Instructions to download and use the digital product.
     */
    public function setInstructions(?string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }
}
