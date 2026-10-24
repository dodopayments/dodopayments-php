<?php

declare(strict_types=1);

namespace Dodopayments\Services\Meters;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Misc\Locale;
use Dodopayments\Products\Translations\Translation;
use Dodopayments\Products\Translations\TranslationsListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Meters\TranslationsContract;

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
     * @param string $id Path param: Meter Id
     * @param string|null $description body param: The translated description
     * @param string|null $name body param: The translated name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        Locale|string $locale,
        string $id,
        ?string $description = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): Translation {
        $params = Util::removeNulls(
            ['id' => $id, 'description' => $description, 'name' => $name]
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
     * @param string $id Meter Id
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
    ): TranslationsListResponse {
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
     * @param string $id Meter Id
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
