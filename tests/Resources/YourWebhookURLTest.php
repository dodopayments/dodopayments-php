<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Disputes\Dispute;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\CustomerLimitedDetails;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\Payment\ProductCart;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\WebhookEvents\WebhookEventType;
use Dodopayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class YourWebhookURLTest extends TestCase
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
        $result = $this->client->yourWebhookURL->create(
            businessID: 'business_id',
            data: Payment::with(
                billing: BillingAddress::with(
                    city: 'city',
                    country: CountryCode::AF,
                    state: 'state',
                    street: 'street',
                    zipcode: 'zipcode',
                ),
                brandID: 'brand_id',
                businessID: 'business_id',
                createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                currency: Currency::AED,
                customer: CustomerLimitedDetails::with(
                    customerID: 'customer_id',
                    email: 'email',
                    name: 'name'
                ),
                digitalProductsDelivered: true,
                disputes: [
                    Dispute::with(
                        amount: 'amount',
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        currency: 'currency',
                        disputeID: 'dispute_id',
                        disputeStage: DisputeStage::PRE_DISPUTE,
                        disputeStatus: DisputeStatus::DISPUTE_OPENED,
                        paymentID: 'payment_id',
                    ),
                ],
                metadata: ['foo' => 'string'],
                paymentID: 'payment_id',
                refunds: [
                    Refund::with(
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        isPartial: true,
                        paymentID: 'payment_id',
                        refundID: 'refund_id',
                        status: RefundStatus::SUCCEEDED,
                    ),
                ],
                settlementAmount: 0,
                settlementCurrency: Currency::AED,
                totalAmount: 0,
                payloadType: 'Payment',
            ),
            timestamp: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            type: WebhookEventType::PAYMENT_SUCCEEDED,
            webhookID: 'webhook-id',
            webhookSignature: 'webhook-signature',
            webhookTimestamp: 'webhook-timestamp',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->yourWebhookURL->create(
            businessID: 'business_id',
            data: Payment::with(
                billing: BillingAddress::with(
                    city: 'city',
                    country: CountryCode::AF,
                    state: 'state',
                    street: 'street',
                    zipcode: 'zipcode',
                ),
                brandID: 'brand_id',
                businessID: 'business_id',
                createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                currency: Currency::AED,
                customer: CustomerLimitedDetails::with(
                    customerID: 'customer_id',
                    email: 'email',
                    name: 'name'
                ),
                digitalProductsDelivered: true,
                disputes: [
                    Dispute::with(
                        amount: 'amount',
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        currency: 'currency',
                        disputeID: 'dispute_id',
                        disputeStage: DisputeStage::PRE_DISPUTE,
                        disputeStatus: DisputeStatus::DISPUTE_OPENED,
                        paymentID: 'payment_id',
                    )
                        ->withRemarks('remarks'),
                ],
                metadata: ['foo' => 'string'],
                paymentID: 'payment_id',
                refunds: [
                    Refund::with(
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        isPartial: true,
                        paymentID: 'payment_id',
                        refundID: 'refund_id',
                        status: RefundStatus::SUCCEEDED,
                    )
                        ->withAmount(0)
                        ->withCurrency(Currency::AED)
                        ->withReason('reason'),
                ],
                settlementAmount: 0,
                settlementCurrency: Currency::AED,
                totalAmount: 0,
                payloadType: 'Payment',
            )
                ->withCardIssuingCountry(CountryCode::AF)
                ->withCardLastFour('card_last_four')
                ->withCardNetwork('card_network')
                ->withCardType('card_type')
                ->withDiscountID('discount_id')
                ->withErrorCode('error_code')
                ->withErrorMessage('error_message')
                ->withPaymentLink('payment_link')
                ->withPaymentMethod('payment_method')
                ->withPaymentMethodType('payment_method_type')
                ->withProductCart(
                    [ProductCart::with(productID: 'product_id', quantity: 0)]
                )
                ->withSettlementTax(0)
                ->withStatus(IntentStatus::SUCCEEDED)
                ->withSubscriptionID('subscription_id')
                ->withTax(0)
                ->withUpdatedAt(new \DateTimeImmutable('2019-12-27T18:11:19.117Z')),
            timestamp: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            type: WebhookEventType::PAYMENT_SUCCEEDED,
            webhookID: 'webhook-id',
            webhookSignature: 'webhook-signature',
            webhookTimestamp: 'webhook-timestamp',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
