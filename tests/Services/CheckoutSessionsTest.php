<?php

namespace Tests\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
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

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
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
            allowedPaymentMethodTypes: [PaymentMethodTypes::CREDIT],
            billingAddress: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            billingCurrency: Currency::AED,
            confirm: true,
            customer: ['customerID' => 'customer_id'],
            customization: [
                'forceLanguage' => 'force_language',
                'showOnDemandTag' => true,
                'showOrderDetails' => true,
                'theme' => 'dark',
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
}
