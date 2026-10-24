<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Returns the full details of a single credit entitlement including all configuration
 * settings for expiration, rollover, and overage policies.
 *
 * # Authentication
 * Requires an API key with `Viewer` role or higher.
 *
 * # Path Parameters
 * - `id` - The unique identifier of the credit entitlement (format: `cde_...`)
 *
 * # Responses
 * - `200 OK` - Returns the full credit entitlement object
 * - `404 Not Found` - Credit entitlement does not exist or does not belong to the authenticated business
 * - `500 Internal Server Error` - Database or server error
 *
 * # Business Logic
 * - Only non-deleted credit entitlements can be retrieved through this endpoint
 * - The entitlement must belong to the authenticated business (business_id check)
 * - Deleted entitlements return a 404 error and must be retrieved via the list endpoint with `deleted=true`
 *
 * @see Dodopayments\Services\CreditEntitlementsService::retrieve()
 *
 * @phpstan-type CreditEntitlementRetrieveParamsShape = array{locale?: string|null}
 */
final class CreditEntitlementRetrieveParams implements BaseModel
{
    /** @use SdkModel<CreditEntitlementRetrieveParamsShape> */
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
