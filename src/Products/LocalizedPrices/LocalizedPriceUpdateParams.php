<?php

declare(strict_types=1);

namespace Dodopayments\Products\LocalizedPrices;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\Products\LocalizedPricesService::update()
 *
 * @phpstan-type LocalizedPriceUpdateParamsShape = array{
 *   productID: string, amount?: int|null
 * }
 */
final class LocalizedPriceUpdateParams implements BaseModel
{
    /** @use SdkModel<LocalizedPriceUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $productID;

    /**
     * New amount in the smallest currency unit (e.g., cents). Must be greater
     * than zero. The currency and country_code of an existing rule cannot be changed.
     */
    #[Optional(nullable: true)]
    public ?int $amount;

    /**
     * `new LocalizedPriceUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocalizedPriceUpdateParams::with(productID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocalizedPriceUpdateParams)->withProductID(...)
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
    public static function with(string $productID, ?int $amount = null): self
    {
        $self = new self;

        $self['productID'] = $productID;

        null !== $amount && $self['amount'] = $amount;

        return $self;
    }

    public function withProductID(string $productID): self
    {
        $self = clone $this;
        $self['productID'] = $productID;

        return $self;
    }

    /**
     * New amount in the smallest currency unit (e.g., cents). Must be greater
     * than zero. The currency and country_code of an existing rule cannot be changed.
     */
    public function withAmount(?int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
