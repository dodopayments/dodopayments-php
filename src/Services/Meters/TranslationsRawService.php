<?php

declare(strict_types=1);

namespace Dodopayments\Services\Meters;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Meters\Translations\TranslationDeleteParams;
use Dodopayments\Meters\Translations\TranslationListParams;
use Dodopayments\Meters\Translations\TranslationUpdateParams;
use Dodopayments\Misc\Locale;
use Dodopayments\Products\Translations\Translation;
use Dodopayments\Products\Translations\TranslationsListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Meters\TranslationsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class TranslationsRawService implements TranslationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates or replaces the translation of one locale. The response is 201 for a new
     * locale and 200 for a replaced locale.
     *
     * @param Locale|value-of<Locale> $locale Path param: A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param array{
     *   id: string, description?: string|null, name?: string|null
     * }|TranslationUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Translation>
     *
     * @throws APIException
     */
    public function update(
        Locale|string $locale,
        array|TranslationUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranslationUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['meters/%1$s/translations/%2$s', $id, $locale],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: Translation::class,
        );
    }

    /**
     * @api
     *
     * Lists the translations, for all the locales or for the locales of the filter.
     *
     * @param string $id Meter Id
     * @param array{locale?: list<string>}|TranslationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TranslationsListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|TranslationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranslationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['meters/%1$s/translations', $id],
            query: $parsed,
            options: $options,
            convert: TranslationsListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes the translation of one locale.
     *
     * @param Locale|value-of<Locale> $locale A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param array{id: string}|TranslationDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        Locale|string $locale,
        array|TranslationDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranslationDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['meters/%1$s/translations/%2$s', $id, $locale],
            options: $options,
            convert: null,
        );
    }
}
