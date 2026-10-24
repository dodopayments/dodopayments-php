<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections\Translations;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Lists the translations, for all the locales or for the locales of the filter.
 *
 * @see Dodopayments\Services\ProductCollections\TranslationsService::list()
 *
 * @phpstan-type TranslationListParamsShape = array{locale?: list<string>|null}
 */
final class TranslationListParams implements BaseModel
{
    /** @use SdkModel<TranslationListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Returns only these locales, for example `?locale=fr&locale=de`. With no value, the
     * response has all the locales.
     *
     * @var list<string>|null $locale
     */
    #[Optional(list: 'string')]
    public ?array $locale;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $locale
     */
    public static function with(?array $locale = null): self
    {
        $self = new self;

        null !== $locale && $self['locale'] = $locale;

        return $self;
    }

    /**
     * Returns only these locales, for example `?locale=fr&locale=de`. With no value, the
     * response has all the locales.
     *
     * @param list<string> $locale
     */
    public function withLocale(array $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }
}
