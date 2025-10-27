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
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsContract;

use const Dodopayments\Core\OMIT as omit;

final class CheckoutSessionsService implements CheckoutSessionsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param list<ProductCart> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     * @param BillingAddress|null $billingAddress Billing address information for the session
     * @param Currency|value-of<Currency>|null $billingCurrency This field is ingored if adaptive pricing is disabled
     * @param bool $confirm If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     * @param AttachExistingCustomer|NewCustomer|null $customer Customer details for the session
     * @param Customization $customization Customization for the checkout session page
     * @param string|null $discountCode
     * @param FeatureFlags $featureFlags
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this session
     * @param array<string,
     * string,>|null $metadata Additional metadata associated with the payment. Defaults to empty if not provided.
     * @param string|null $returnURL the url to redirect after payment failure or success
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer False by default
     * @param SubscriptionData|null $subscriptionData
     *
     * @throws APIException
     */
    public function create(
        $productCart,
        $allowedPaymentMethodTypes = omit,
        $billingAddress = omit,
        $billingCurrency = omit,
        $confirm = omit,
        $customer = omit,
        $customization = omit,
        $discountCode = omit,
        $featureFlags = omit,
        $force3DS = omit,
        $metadata = omit,
        $returnURL = omit,
        $showSavedPaymentMethods = omit,
        $subscriptionData = omit,
        ?RequestOptions $requestOptions = null,
    ): CheckoutSessionResponse {
        $params = [
            'productCart' => $productCart,
            'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
            'billingAddress' => $billingAddress,
            'billingCurrency' => $billingCurrency,
            'confirm' => $confirm,
            'customer' => $customer,
            'customization' => $customization,
            'discountCode' => $discountCode,
            'featureFlags' => $featureFlags,
            'force3DS' => $force3DS,
            'metadata' => $metadata,
            'returnURL' => $returnURL,
            'showSavedPaymentMethods' => $showSavedPaymentMethods,
            'subscriptionData' => $subscriptionData,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): CheckoutSessionResponse {
        [$parsed, $options] = CheckoutSessionCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CheckoutSessionStatus {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['checkouts/%1$s', $id],
            options: $requestOptions,
            convert: CheckoutSessionStatus::class,
        );
    }
}
