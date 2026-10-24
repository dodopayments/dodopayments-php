<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\EntitlementListParams\IntegrationType;

/**
 * GET /entitlements.
 *
 * @see Dodopayments\Services\EntitlementsService::list()
 *
 * @phpstan-type EntitlementListParamsShape = array{
 *   integrationType?: null|IntegrationType|value-of<IntegrationType>,
 *   locale?: string|null,
 *   pageNumber?: int|null,
 *   pageSize?: int|null,
 * }
 */
final class EntitlementListParams implements BaseModel
{
    /** @use SdkModel<EntitlementListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by integration type.
     *
     * @var value-of<IntegrationType>|null $integrationType
     */
    #[Optional(enum: IntegrationType::class)]
    public ?string $integrationType;

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

    /**
     * Page number (default 0).
     */
    #[Optional]
    public ?int $pageNumber;

    /**
     * Page size (default 10, max 100).
     */
    #[Optional]
    public ?int $pageSize;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param IntegrationType|value-of<IntegrationType>|null $integrationType
     */
    public static function with(
        IntegrationType|string|null $integrationType = null,
        ?string $locale = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
    ): self {
        $self = new self;

        null !== $integrationType && $self['integrationType'] = $integrationType;
        null !== $locale && $self['locale'] = $locale;
        null !== $pageNumber && $self['pageNumber'] = $pageNumber;
        null !== $pageSize && $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Filter by integration type.
     *
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public function withIntegrationType(
        IntegrationType|string $integrationType
    ): self {
        $self = clone $this;
        $self['integrationType'] = $integrationType;

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

    /**
     * Page number (default 0).
     */
    public function withPageNumber(int $pageNumber): self
    {
        $self = clone $this;
        $self['pageNumber'] = $pageNumber;

        return $self;
    }

    /**
     * Page size (default 10, max 100).
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
