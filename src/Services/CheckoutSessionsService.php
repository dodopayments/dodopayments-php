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
use Dodopayments\Client;
use Dodopayments\Contracts\CheckoutSessionsContract;
use Dodopayments\Core\Conversion;
use Dodopayments\Core\Util;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;

final class CheckoutSessionsService implements CheckoutSessionsContract
{
    public function __construct(private Client $client) {}

    /**
     * @param list<ProductCart> $productCart
     * @param list<PaymentMethodTypes::*>|null $allowedPaymentMethodTypes Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     * @param BillingAddress|null $billingAddress Billing address information for the session
     * @param Currency::* $billingCurrency This field is ingored if adaptive pricing is disabled
     * @param bool $confirm If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     * @param AttachExistingCustomer|NewCustomer $customer Customer details for the session
     * @param Customization $customization Customization for the checkout session page
     * @param string|null $discountCode
     * @param FeatureFlags $featureFlags
     * @param array<string,
     * string,>|null $metadata Additional metadata associated with the payment. Defaults to empty if not provided.
     * @param string|null $returnURL the url to redirect after payment failure or success
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer False by default
     * @param SubscriptionData|null $subscriptionData
     */
    public function create(
        $productCart,
        $allowedPaymentMethodTypes = null,
        $billingAddress = null,
        $billingCurrency = null,
        $confirm = null,
        $customer = null,
        $customization = null,
        $discountCode = null,
        $featureFlags = null,
        $metadata = null,
        $returnURL = null,
        $showSavedPaymentMethods = null,
        $subscriptionData = null,
        ?RequestOptions $requestOptions = null,
    ): CheckoutSessionResponse {
        $args = [
            'productCart' => $productCart,
            'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
            'billingAddress' => $billingAddress,
            'billingCurrency' => $billingCurrency,
            'confirm' => $confirm,
            'customer' => $customer,
            'customization' => $customization,
            'discountCode' => $discountCode,
            'featureFlags' => $featureFlags,
            'metadata' => $metadata,
            'returnURL' => $returnURL,
            'showSavedPaymentMethods' => $showSavedPaymentMethods,
            'subscriptionData' => $subscriptionData,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'allowedPaymentMethodTypes',
                'billingAddress',
                'billingCurrency',
                'confirm',
                'customer',
                'customization',
                'discountCode',
                'featureFlags',
                'metadata',
                'returnURL',
                'showSavedPaymentMethods',
                'subscriptionData',
            ],
        );
        [$parsed, $options] = CheckoutSessionCreateParams::parseRequest(
            $args,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'checkouts',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(CheckoutSessionResponse::class, value: $resp);
    }
}
