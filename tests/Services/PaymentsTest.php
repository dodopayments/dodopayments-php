<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Payments\PaymentNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PaymentsTest extends TestCase
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
        $result = $this->client->payments->create(
            billing: ['country' => CountryCode::AF],
            customer: ['customerID' => 'customer_id'],
            productCart: [['productID' => 'product_id', 'quantity' => 0]],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PaymentNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->payments->create(
            billing: [
                'country' => CountryCode::AF,
                'city' => 'city',
                'state' => 'state',
                'street' => 'street',
                'zipcode' => 'zipcode',
            ],
            customer: ['customerID' => 'customer_id'],
            productCart: [
                ['productID' => 'product_id', 'quantity' => 0, 'amount' => 0],
            ],
            allowedPaymentMethodTypes: [PaymentMethodTypes::CREDIT],
            billingCurrency: Currency::AED,
            discountCode: 'discount_code',
            force3DS: true,
            metadata: ['foo' => 'string'],
            paymentLink: true,
            returnURL: 'return_url',
            showSavedPaymentMethods: true,
            taxID: 'tax_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PaymentNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->payments->retrieve('payment_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Payment::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->payments->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }

    #[Test]
    public function testRetrieveLineItems(): void
    {
        $result = $this->client->payments->retrieveLineItems('payment_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PaymentGetLineItemsResponse::class, $result);
    }
}
