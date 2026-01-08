<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\BillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\FeatureFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\SubscriptionData;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsRawContract;

/**
 * @phpstan-import-type ProductCartShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart
 * @phpstan-import-type BillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\BillingAddress
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type CustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization
 * @phpstan-import-type FeatureFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\FeatureFlags
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\SubscriptionData
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
     *   productCart: list<ProductCart|ProductCartShape>,
     *   allowedPaymentMethodTypes?: list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null,
     *   billingAddress?: BillingAddress|BillingAddressShape|null,
     *   billingCurrency?: value-of<Currency>,
     *   confirm?: bool,
     *   customer?: CustomerRequestShape|null,
     *   customization?: Customization|CustomizationShape,
     *   discountCode?: string|null,
     *   featureFlags?: FeatureFlags|FeatureFlagsShape,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>|null,
     *   minimalAddress?: bool,
     *   paymentMethodID?: string|null,
     *   returnURL?: string|null,
     *   shortLink?: bool,
     *   showSavedPaymentMethods?: bool,
     *   subscriptionData?: SubscriptionData|SubscriptionDataShape|null,
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
}
