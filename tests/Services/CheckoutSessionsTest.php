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
        $result = $this->client->checkoutSessions->create([
            'product_cart' => [['product_id' => 'product_id', 'quantity' => 0]],
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CheckoutSessionResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkoutSessions->create([
            'product_cart' => [
                [
                    'product_id' => 'product_id',
                    'quantity' => 0,
                    'addons' => [['addon_id' => 'addon_id', 'quantity' => 0]],
                    'amount' => 0,
                ],
            ],
            'allowed_payment_method_types' => [PaymentMethodTypes::CREDIT],
            'billing_address' => [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            'billing_currency' => Currency::AED,
            'confirm' => true,
            'customer' => ['customer_id' => 'customer_id'],
            'customization' => [
                'force_language' => 'force_language',
                'show_on_demand_tag' => true,
                'show_order_details' => true,
                'theme' => 'dark',
            ],
            'discount_code' => 'discount_code',
            'feature_flags' => [
                'allow_currency_selection' => true,
                'allow_customer_editing_city' => true,
                'allow_customer_editing_country' => true,
                'allow_customer_editing_email' => true,
                'allow_customer_editing_name' => true,
                'allow_customer_editing_state' => true,
                'allow_customer_editing_street' => true,
                'allow_customer_editing_zipcode' => true,
                'allow_discount_code' => true,
                'allow_phone_number_collection' => true,
                'allow_tax_id' => true,
                'always_create_new_customer' => true,
            ],
            'force_3ds' => true,
            'metadata' => ['foo' => 'string'],
            'minimal_address' => true,
            'return_url' => 'return_url',
            'show_saved_payment_methods' => true,
            'subscription_data' => [
                'on_demand' => [
                    'mandate_only' => true,
                    'adaptive_currency_fees_inclusive' => true,
                    'product_currency' => Currency::AED,
                    'product_description' => 'product_description',
                    'product_price' => 0,
                ],
                'trial_period_days' => 0,
            ],
        ]);

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
