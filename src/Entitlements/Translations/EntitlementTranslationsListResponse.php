<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Translations;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The translations of an entitlement.
 *
 * @phpstan-import-type EntitlementTranslationShape from \Dodopayments\Entitlements\Translations\EntitlementTranslation
 *
 * @phpstan-type EntitlementTranslationsListResponseShape = array{
 *   items: list<EntitlementTranslation|EntitlementTranslationShape>
 * }
 */
final class EntitlementTranslationsListResponse implements BaseModel
{
    /** @use SdkModel<EntitlementTranslationsListResponseShape> */
    use SdkModel;

    /** @var list<EntitlementTranslation> $items */
    #[Required(list: EntitlementTranslation::class)]
    public array $items;

    /**
     * `new EntitlementTranslationsListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementTranslationsListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementTranslationsListResponse)->withItems(...)
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
     * @param list<EntitlementTranslation|EntitlementTranslationShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<EntitlementTranslation|EntitlementTranslationShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
