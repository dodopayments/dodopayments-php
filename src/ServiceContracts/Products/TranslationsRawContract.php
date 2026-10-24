<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Products;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\Locale;
use Dodopayments\Products\Translations\Translation;
use Dodopayments\Products\Translations\TranslationDeleteParams;
use Dodopayments\Products\Translations\TranslationListParams;
use Dodopayments\Products\Translations\TranslationsListResponse;
use Dodopayments\Products\Translations\TranslationUpdateParams;
use Dodopayments\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
interface TranslationsRawContract
{
    /**
     * @api
     *
     * @param Locale|string $locale Path param: A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param array<string,mixed>|TranslationUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id Product Id
     * @param array<string,mixed>|TranslationListParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param Locale|string $locale A locale that the checkout and the customer portal can show.
     *
     * The codes are a copy of the checkout locales. `GET /locales` lists them.
     * @param array<string,mixed>|TranslationDeleteParams $params
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
    ): BaseResponse;
}
