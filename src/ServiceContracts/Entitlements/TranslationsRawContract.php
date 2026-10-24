<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts\Entitlements;

use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Entitlements\Translations\EntitlementTranslation;
use Dodopayments\Entitlements\Translations\EntitlementTranslationsListResponse;
use Dodopayments\Entitlements\Translations\TranslationDeleteParams;
use Dodopayments\Entitlements\Translations\TranslationListParams;
use Dodopayments\Entitlements\Translations\TranslationUpdateParams;
use Dodopayments\Misc\Locale;
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
     * @return BaseResponse<EntitlementTranslation>
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
     * @param string $id Entitlement Id
     * @param array<string,mixed>|TranslationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EntitlementTranslationsListResponse>
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
