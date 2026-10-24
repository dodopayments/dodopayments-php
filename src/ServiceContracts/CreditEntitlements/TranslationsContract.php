<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\CreditEntitlements;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslation;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslationsListResponse;
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
     * @param string $id Path param: Credit Entitlement Id
     * @param string|null $name body param: The translated name
     * @param string|null $unit body param: The translated unit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        Locale|string $locale,
        string $id,
        ?string $name = null,
        ?string $unit = null,
        RequestOptions|array|null $requestOptions = null,
    ): CreditEntitlementTranslation;

    /**
     * @api
     *
     * @param string $id Credit Entitlement Id
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
    ): CreditEntitlementTranslationsListResponse;

    /**
     * @api
     *
     * @param Locale|string $locale A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param string $id Credit Entitlement Id
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
