<?php

namespace Tests\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionPreviewResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CheckoutSessionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->checkoutSessions->create(
            productCart: [['productID' => 'product_id', 'quantity' => 0]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkoutSessions->create(
            productCart: [
                [
                    'productID' => 'product_id',
                    'quantity' => 0,
                    'addons' => [['addonID' => 'addon_id', 'quantity' => 0]],
                    'amount' => 0,
                ],
            ],
            allowedPaymentMethodTypes: [PaymentMethodTypes::ACH],
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            billingCurrency: Currency::AED,
            confirm: true,
            customFields: [
                [
                    'fieldType' => 'text',
                    'key' => 'key',
                    'label' => 'label',
                    'options' => ['string'],
                    'placeholder' => 'placeholder',
                    'required' => true,
                ],
            ],
            customer: ['customerID' => 'customer_id'],
            customization: [
                'forceLanguage' => 'force_language',
                'showOnDemandTag' => true,
                'showOrderDetails' => true,
                'theme' => 'dark',
                'themeConfig' => [
                    'dark' => [
                        'bgPrimary' => 'bg_primary',
                        'bgSecondary' => 'bg_secondary',
                        'borderPrimary' => 'border_primary',
                        'borderSecondary' => 'border_secondary',
                        'buttonPrimary' => 'button_primary',
                        'buttonPrimaryHover' => 'button_primary_hover',
                        'buttonSecondary' => 'button_secondary',
                        'buttonSecondaryHover' => 'button_secondary_hover',
                        'buttonTextPrimary' => 'button_text_primary',
                        'buttonTextSecondary' => 'button_text_secondary',
                        'inputFocusBorder' => 'input_focus_border',
                        'textError' => 'text_error',
                        'textPlaceholder' => 'text_placeholder',
                        'textPrimary' => 'text_primary',
                        'textSecondary' => 'text_secondary',
                        'textSuccess' => 'text_success',
                    ],
                    'fontSize' => 'xs',
                    'fontWeight' => 'normal',
                    'light' => [
                        'bgPrimary' => 'bg_primary',
                        'bgSecondary' => 'bg_secondary',
                        'borderPrimary' => 'border_primary',
                        'borderSecondary' => 'border_secondary',
                        'buttonPrimary' => 'button_primary',
                        'buttonPrimaryHover' => 'button_primary_hover',
                        'buttonSecondary' => 'button_secondary',
                        'buttonSecondaryHover' => 'button_secondary_hover',
                        'buttonTextPrimary' => 'button_text_primary',
                        'buttonTextSecondary' => 'button_text_secondary',
                        'inputFocusBorder' => 'input_focus_border',
                        'textError' => 'text_error',
                        'textPlaceholder' => 'text_placeholder',
                        'textPrimary' => 'text_primary',
                        'textSecondary' => 'text_secondary',
                        'textSuccess' => 'text_success',
                    ],
                    'payButtonText' => 'pay_button_text',
                    'radius' => 'radius',
                ],
            ],
            discountCode: 'discount_code',
            featureFlags: [
                'allowCurrencySelection' => true,
                'allowCustomerEditingCity' => true,
                'allowCustomerEditingCountry' => true,
                'allowCustomerEditingEmail' => true,
                'allowCustomerEditingName' => true,
                'allowCustomerEditingState' => true,
                'allowCustomerEditingStreet' => true,
                'allowCustomerEditingZipcode' => true,
                'allowDiscountCode' => true,
                'allowPhoneNumberCollection' => true,
                'allowTaxID' => true,
                'alwaysCreateNewCustomer' => true,
                'redirectImmediately' => true,
            ],
            force3DS: true,
            metadata: ['foo' => 'string'],
            minimalAddress: true,
            paymentMethodID: 'payment_method_id',
            productCollectionID: 'product_collection_id',
            returnURL: 'return_url',
            shortLink: true,
            showSavedPaymentMethods: true,
            subscriptionData: [
                'onDemand' => [
                    'mandateOnly' => true,
                    'adaptiveCurrencyFeesInclusive' => true,
                    'productCurrency' => Currency::AED,
                    'productDescription' => 'product_description',
                    'productPrice' => 0,
                ],
                'trialPeriodDays' => 0,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->checkoutSessions->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionStatus::class, $result);
    }

    #[Test]
    public function testPreview(): void
    {
        $result = $this->client->checkoutSessions->preview(
            productCart: [['productID' => 'product_id', 'quantity' => 0]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionPreviewResponse::class, $result);
    }

    #[Test]
    public function testPreviewWithOptionalParams(): void
    {
        $result = $this->client->checkoutSessions->preview(
            productCart: [
                [
                    'productID' => 'product_id',
                    'quantity' => 0,
                    'addons' => [['addonID' => 'addon_id', 'quantity' => 0]],
                    'amount' => 0,
                ],
            ],
            allowedPaymentMethodTypes: [PaymentMethodTypes::ACH],
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            billingCurrency: Currency::AED,
            confirm: true,
            customFields: [
                [
                    'fieldType' => 'text',
                    'key' => 'key',
                    'label' => 'label',
                    'options' => ['string'],
                    'placeholder' => 'placeholder',
                    'required' => true,
                ],
            ],
            customer: ['customerID' => 'customer_id'],
            customization: [
                'forceLanguage' => 'force_language',
                'showOnDemandTag' => true,
                'showOrderDetails' => true,
                'theme' => 'dark',
                'themeConfig' => [
                    'dark' => [
                        'bgPrimary' => 'bg_primary',
                        'bgSecondary' => 'bg_secondary',
                        'borderPrimary' => 'border_primary',
                        'borderSecondary' => 'border_secondary',
                        'buttonPrimary' => 'button_primary',
                        'buttonPrimaryHover' => 'button_primary_hover',
                        'buttonSecondary' => 'button_secondary',
                        'buttonSecondaryHover' => 'button_secondary_hover',
                        'buttonTextPrimary' => 'button_text_primary',
                        'buttonTextSecondary' => 'button_text_secondary',
                        'inputFocusBorder' => 'input_focus_border',
                        'textError' => 'text_error',
                        'textPlaceholder' => 'text_placeholder',
                        'textPrimary' => 'text_primary',
                        'textSecondary' => 'text_secondary',
                        'textSuccess' => 'text_success',
                    ],
                    'fontSize' => 'xs',
                    'fontWeight' => 'normal',
                    'light' => [
                        'bgPrimary' => 'bg_primary',
                        'bgSecondary' => 'bg_secondary',
                        'borderPrimary' => 'border_primary',
                        'borderSecondary' => 'border_secondary',
                        'buttonPrimary' => 'button_primary',
                        'buttonPrimaryHover' => 'button_primary_hover',
                        'buttonSecondary' => 'button_secondary',
                        'buttonSecondaryHover' => 'button_secondary_hover',
                        'buttonTextPrimary' => 'button_text_primary',
                        'buttonTextSecondary' => 'button_text_secondary',
                        'inputFocusBorder' => 'input_focus_border',
                        'textError' => 'text_error',
                        'textPlaceholder' => 'text_placeholder',
                        'textPrimary' => 'text_primary',
                        'textSecondary' => 'text_secondary',
                        'textSuccess' => 'text_success',
                    ],
                    'payButtonText' => 'pay_button_text',
                    'radius' => 'radius',
                ],
            ],
            discountCode: 'discount_code',
            featureFlags: [
                'allowCurrencySelection' => true,
                'allowCustomerEditingCity' => true,
                'allowCustomerEditingCountry' => true,
                'allowCustomerEditingEmail' => true,
                'allowCustomerEditingName' => true,
                'allowCustomerEditingState' => true,
                'allowCustomerEditingStreet' => true,
                'allowCustomerEditingZipcode' => true,
                'allowDiscountCode' => true,
                'allowPhoneNumberCollection' => true,
                'allowTaxID' => true,
                'alwaysCreateNewCustomer' => true,
                'redirectImmediately' => true,
            ],
            force3DS: true,
            metadata: ['foo' => 'string'],
            minimalAddress: true,
            paymentMethodID: 'payment_method_id',
            productCollectionID: 'product_collection_id',
            returnURL: 'return_url',
            shortLink: true,
            showSavedPaymentMethods: true,
            subscriptionData: [
                'onDemand' => [
                    'mandateOnly' => true,
                    'adaptiveCurrencyFeesInclusive' => true,
                    'productCurrency' => Currency::AED,
                    'productDescription' => 'product_description',
                    'productPrice' => 0,
                ],
                'trialPeriodDays' => 0,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionPreviewResponse::class, $result);
    }
}
