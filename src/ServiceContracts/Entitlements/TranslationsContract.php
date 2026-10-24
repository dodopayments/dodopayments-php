<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Entitlements\Translations\EntitlementTranslation;
use Dodopayments\Entitlements\Translations\EntitlementTranslationsListResponse;
use Dodopayments\Misc\Locale;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface TranslationsContract
{
    /**
     * @api
     *
     * @param Locale|string $locale Path param: A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param string $id Path param: Entitlement Id
     * @param string|null $activationMessage Body param: The translated activation message. Only a `license_key` entitlement has it.
     * @param string|null $description body param: The translated description
     * @param string|null $instructions Body param: The translated delivery instructions. Only a `digital_files` entitlement has them.
     * @param string|null $name body param: The translated name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        Locale|string $locale,
        string $id,
        ?string $activationMessage = null,
        ?string $description = null,
        ?string $instructions = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntitlementTranslation;

    /**
     * @api
     *
     * @param string $id Entitlement Id
     * @param list<string> $locale Returns only these locales, for example `?locale=fr&locale=de`. With no value, the
     * response has all the locales.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?array $locale = null,
        RequestOptions|array|null $requestOptions = null,
    ): EntitlementTranslationsListResponse;

    /**
     * @api
     *
     * @param Locale|string $locale A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param string $id Entitlement Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        Locale|string $locale,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
