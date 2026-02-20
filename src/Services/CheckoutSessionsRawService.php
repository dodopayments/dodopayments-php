<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionBillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionCustomization;
use Dodopayments\CheckoutSessions\CheckoutSessionFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\CheckoutSessions\CustomField;
use Dodopayments\CheckoutSessions\ProductItemReq;
use Dodopayments\CheckoutSessions\SubscriptionData;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsRawContract;

/**
 * @phpstan-import-type ProductItemReqShape from \Dodopayments\CheckoutSessions\ProductItemReq
 * @phpstan-import-type CheckoutSessionBillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionBillingAddress
 * @phpstan-import-type CustomFieldShape from \Dodopayments\CheckoutSessions\CustomField
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type CheckoutSessionCustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionCustomization
 * @phpstan-import-type CheckoutSessionFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionFlags
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\SubscriptionData
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CheckoutSessionsRawService implements CheckoutSessionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   productCart: list<ProductItemReq|ProductItemReqShape>,
     *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
     *   billingAddress?: CheckoutSessionBillingAddress|CheckoutSessionBillingAddressShape|null,
     *   billingCurrency?: value-of<Currency>,
     *   confirm?: bool,
     *   customFields?: list<CustomField|CustomFieldShape>|null,
     *   customer?: CustomerRequestShape|null,
     *   customization?: CheckoutSessionCustomization|CheckoutSessionCustomizationShape,
     *   discountCode?: string|null,
     *   featureFlags?: CheckoutSessionFlags|CheckoutSessionFlagsShape,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>|null,
     *   minimalAddress?: bool,
     *   paymentMethodID?: string|null,
     *   productCollectionID?: string|null,
     *   returnURL?: string|null,
     *   shortLink?: bool,
     *   showSavedPaymentMethods?: bool,
     *   subscriptionData?: SubscriptionData|SubscriptionDataShape|null,
     *   taxID?: string|null,
     * }|CheckoutSessionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckoutSessionResponse>
     *
     * @throws APIException
     */
    public function create(
        array|CheckoutSessionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckoutSessionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'checkouts',
            body: (object) $parsed,
            options: $options,
            convert: CheckoutSessionResponse::class,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckoutSessionStatus>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['checkouts/%1$s', $id],
            options: $requestOptions,
            convert: CheckoutSessionStatus::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   productCart: list<ProductItemReq|ProductItemReqShape>,
     *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
     *   billingAddress?: CheckoutSessionBillingAddress|CheckoutSessionBillingAddressShape|null,
     *   billingCurrency?: value-of<Currency>,
     *   confirm?: bool,
     *   customFields?: list<CustomField|CustomFieldShape>|null,
     *   customer?: CustomerRequestShape|null,
     *   customization?: CheckoutSessionCustomization|CheckoutSessionCustomizationShape,
     *   discountCode?: string|null,
     *   featureFlags?: CheckoutSessionFlags|CheckoutSessionFlagsShape,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>|null,
     *   minimalAddress?: bool,
     *   paymentMethodID?: string|null,
     *   productCollectionID?: string|null,
     *   returnURL?: string|null,
     *   shortLink?: bool,
     *   showSavedPaymentMethods?: bool,
     *   subscriptionData?: SubscriptionData|SubscriptionDataShape|null,
     *   taxID?: string|null,
     * }|CheckoutSessionPreviewParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckoutSessionPreviewResponse>
     *
     * @throws APIException
     */
    public function preview(
        array|CheckoutSessionPreviewParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckoutSessionPreviewParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'checkouts/preview',
            body: (object) $parsed,
            options: $options,
            convert: CheckoutSessionPreviewResponse::class,
        );
    }
}
