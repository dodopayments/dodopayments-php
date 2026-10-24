<?php

declare(strict_types=1);

namespace Dodopayments\Services\CreditEntitlements;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslation;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslationsListResponse;
use Dodopayments\Misc\Locale;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CreditEntitlements\TranslationsContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class TranslationsService implements TranslationsContract
{
    /**
     * @api
     */
    public TranslationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranslationsRawService($client);
    }

    /**
     * @api
     *
     * Creates or replaces the translation of one locale. The response is 201 for a new
     * locale and 200 for a replaced locale.
     *
     * @param Locale|value-of<Locale> $locale Path param: A locale that the checkout and the customer portal can show.
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
    ): CreditEntitlementTranslation {
        $params = Util::removeNulls(
            ['id' => $id, 'name' => $name, 'unit' => $unit]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($locale, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists the translations, for all the locales or for the locales of the filter.
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
    ): CreditEntitlementTranslationsListResponse {
        $params = Util::removeNulls(['locale' => $locale]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes the translation of one locale.
     *
     * @param Locale|value-of<Locale> $locale A locale that the checkout and the customer portal can show.
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
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($locale, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
