<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\BillingAddress;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\CustomField;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\FeatureFlags;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\SubscriptionData;
use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\AttachExistingCustomer;
use Dodopayments\Payments\NewCustomer;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsContract;

/**
 * @phpstan-import-type ProductCartShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart
 * @phpstan-import-type BillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\BillingAddress
 * @phpstan-import-type CustomFieldShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\CustomField
 * @phpstan-import-type CustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization
 * @phpstan-import-type FeatureFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\FeatureFlags
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\SubscriptionData
 * @phpstan-import-type ProductCartShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\ProductCart as ProductCartShape1
 * @phpstan-import-type BillingAddressShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\BillingAddress as BillingAddressShape1
 * @phpstan-import-type CustomFieldShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\CustomField as CustomFieldShape1
 * @phpstan-import-type CustomizationShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization as CustomizationShape1
 * @phpstan-import-type FeatureFlagsShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\FeatureFlags as FeatureFlagsShape1
 * @phpstan-import-type SubscriptionDataShape from \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\SubscriptionData as SubscriptionDataShape1
 * @phpstan-import-type CustomerRequestShape from \Dodopayments\Payments\CustomerRequest
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class CheckoutSessionsService implements CheckoutSessionsContract
{
    /**
     * @api
     */
    public CheckoutSessionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckoutSessionsRawService($client);
    }

    /**
     * @api
     *
     * @param list<ProductCart|ProductCartShape> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     * @param BillingAddress|BillingAddressShape|null $billingAddress Billing address information for the session
     * @param Currency|value-of<Currency>|null $billingCurrency This field is ingored if adaptive pricing is disabled
     * @param bool $confirm If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     * @param list<CustomField|CustomFieldShape>|null $customFields Custom fields to collect from customer during checkout (max 5 fields)
     * @param CustomerRequestShape|null $customer Customer details for the session
     * @param Customization|CustomizationShape $customization Customization for the checkout session page
     * @param FeatureFlags|FeatureFlagsShape $featureFlags
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this session
     * @param array<string,string>|null $metadata Additional metadata associated with the payment. Defaults to empty if not provided.
     * @param bool $minimalAddress If true, only zipcode is required when confirm is true; other address fields remain optional
     * @param string|null $paymentMethodID Optional payment method ID to use for this checkout session.
     * Only allowed when `confirm` is true.
     * If provided, existing customer id must also be provided.
     * @param string|null $productCollectionID Product collection ID for collection-based checkout flow
     * @param string|null $returnURL the url to redirect after payment failure or success
     * @param bool $shortLink If true, returns a shortened checkout URL.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer False by default
     * @param SubscriptionData|SubscriptionDataShape|null $subscriptionData
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        BillingAddress|array|null $billingAddress = null,
        Currency|string|null $billingCurrency = null,
        ?bool $confirm = null,
        ?array $customFields = null,
        AttachExistingCustomer|array|NewCustomer|null $customer = null,
        Customization|array|null $customization = null,
        ?string $discountCode = null,
        FeatureFlags|array|null $featureFlags = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $minimalAddress = null,
        ?string $paymentMethodID = null,
        ?string $productCollectionID = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        SubscriptionData|array|null $subscriptionData = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckoutSessionResponse {
        $params = Util::removeNulls(
            [
                'productCart' => $productCart,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingAddress' => $billingAddress,
                'billingCurrency' => $billingCurrency,
                'confirm' => $confirm,
                'customFields' => $customFields,
                'customer' => $customer,
                'customization' => $customization,
                'discountCode' => $discountCode,
                'featureFlags' => $featureFlags,
                'force3DS' => $force3DS,
                'metadata' => $metadata,
                'minimalAddress' => $minimalAddress,
                'paymentMethodID' => $paymentMethodID,
                'productCollectionID' => $productCollectionID,
                'returnURL' => $returnURL,
                'shortLink' => $shortLink,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'subscriptionData' => $subscriptionData,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): CheckoutSessionStatus {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param list<\Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\ProductCart|ProductCartShape1> $productCart
     * @param list<PaymentMethodTypes|value-of<PaymentMethodTypes>>|null $allowedPaymentMethodTypes Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     * @param \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\BillingAddress|BillingAddressShape1|null $billingAddress Billing address information for the session
     * @param Currency|value-of<Currency>|null $billingCurrency This field is ingored if adaptive pricing is disabled
     * @param bool $confirm If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     * @param list<\Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\CustomField|CustomFieldShape1>|null $customFields Custom fields to collect from customer during checkout (max 5 fields)
     * @param CustomerRequestShape|null $customer Customer details for the session
     * @param \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization|CustomizationShape1 $customization Customization for the checkout session page
     * @param \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\FeatureFlags|FeatureFlagsShape1 $featureFlags
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this session
     * @param array<string,string>|null $metadata Additional metadata associated with the payment. Defaults to empty if not provided.
     * @param bool $minimalAddress If true, only zipcode is required when confirm is true; other address fields remain optional
     * @param string|null $paymentMethodID Optional payment method ID to use for this checkout session.
     * Only allowed when `confirm` is true.
     * If provided, existing customer id must also be provided.
     * @param string|null $productCollectionID Product collection ID for collection-based checkout flow
     * @param string|null $returnURL the url to redirect after payment failure or success
     * @param bool $shortLink If true, returns a shortened checkout URL.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer False by default
     * @param \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\SubscriptionData|SubscriptionDataShape1|null $subscriptionData
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function preview(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\BillingAddress|array|null $billingAddress = null,
        Currency|string|null $billingCurrency = null,
        ?bool $confirm = null,
        ?array $customFields = null,
        AttachExistingCustomer|array|NewCustomer|null $customer = null,
        \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\Customization|array|null $customization = null,
        ?string $discountCode = null,
        \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\FeatureFlags|array|null $featureFlags = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $minimalAddress = null,
        ?string $paymentMethodID = null,
        ?string $productCollectionID = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        \Dodopayments\CheckoutSessions\CheckoutSessionPreviewParams\SubscriptionData|array|null $subscriptionData = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckoutSessionPreviewResponse {
        $params = Util::removeNulls(
            [
                'productCart' => $productCart,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingAddress' => $billingAddress,
                'billingCurrency' => $billingCurrency,
                'confirm' => $confirm,
                'customFields' => $customFields,
                'customer' => $customer,
                'customization' => $customization,
                'discountCode' => $discountCode,
                'featureFlags' => $featureFlags,
                'force3DS' => $force3DS,
                'metadata' => $metadata,
                'minimalAddress' => $minimalAddress,
                'paymentMethodID' => $paymentMethodID,
                'productCollectionID' => $productCollectionID,
                'returnURL' => $returnURL,
                'shortLink' => $shortLink,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'subscriptionData' => $subscriptionData,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->preview(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
