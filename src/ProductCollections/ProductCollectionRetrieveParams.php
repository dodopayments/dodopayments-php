<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @see Dodopayments\Services\ProductCollectionsService::retrieve()
 *
 * @phpstan-type ProductCollectionRetrieveParamsShape = array{locale?: string|null}
 */
final class ProductCollectionRetrieveParams implements BaseModel
{
    /** @use SdkModel<ProductCollectionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     */
    #[Optional]
    public ?string $locale;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $locale = null): self
    {
        $self = new self;

        null !== $locale && $self['locale'] = $locale;

        return $self;
    }

    /**
     * Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     */
    public function withLocale(string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }
}
