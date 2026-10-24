<?php

declare(strict_types=1);

namespace Dodopayments\Products\Translations;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The translations of a product, an add-on, a product collection or a meter.
 *
 * @phpstan-import-type TranslationShape from \Dodopayments\Products\Translations\Translation
 *
 * @phpstan-type TranslationsListResponseShape = array{
 *   items: list<Translation|TranslationShape>
 * }
 */
final class TranslationsListResponse implements BaseModel
{
    /** @use SdkModel<TranslationsListResponseShape> */
    use SdkModel;

    /** @var list<Translation> $items */
    #[Required(list: Translation::class)]
    public array $items;

    /**
     * `new TranslationsListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranslationsListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranslationsListResponse)->withItems(...)
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
     * @param list<Translation|TranslationShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<Translation|TranslationShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
