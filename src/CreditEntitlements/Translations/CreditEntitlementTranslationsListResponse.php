<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Translations;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The translations of a credit entitlement.
 *
 * @phpstan-import-type CreditEntitlementTranslationShape from \Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslation
 *
 * @phpstan-type CreditEntitlementTranslationsListResponseShape = array{
 *   items: list<CreditEntitlementTranslation|CreditEntitlementTranslationShape>
 * }
 */
final class CreditEntitlementTranslationsListResponse implements BaseModel
{
    /** @use SdkModel<CreditEntitlementTranslationsListResponseShape> */
    use SdkModel;

    /** @var list<CreditEntitlementTranslation> $items */
    #[Required(list: CreditEntitlementTranslation::class)]
    public array $items;

    /**
     * `new CreditEntitlementTranslationsListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditEntitlementTranslationsListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditEntitlementTranslationsListResponse)->withItems(...)
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
     * @param list<CreditEntitlementTranslation|CreditEntitlementTranslationShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<CreditEntitlementTranslation|CreditEntitlementTranslationShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
