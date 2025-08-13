<?php

namespace Tests\Resources;

use DodoPayments\Client;
use DodoPayments\Disputes\Dispute;
use DodoPayments\Disputes\DisputeStage;
use DodoPayments\Disputes\DisputeStatus;
use DodoPayments\Misc\CountryCode;
use DodoPayments\Misc\Currency;
use DodoPayments\Payments\BillingAddress;
use DodoPayments\Payments\CustomerLimitedDetails;
use DodoPayments\Payments\IntentStatus;
use DodoPayments\Payments\Payment\ProductCart;
use DodoPayments\Refunds\Refund;
use DodoPayments\Refunds\RefundStatus;
use DodoPayments\WebhookEvents\WebhookEventType;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams;
use DodoPayments\YourWebhookURL\YourWebhookURLCreateParams\Data\Payment;
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
        $params = YourWebhookURLCreateParams::from(
            businessID: 'business_id',
            data: Payment::from(
                billing: BillingAddress::from(
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
                customer: CustomerLimitedDetails::from(
                    customerID: 'customer_id',
                    email: 'email',
                    name: 'name'
                ),
                digitalProductsDelivered: true,
                disputes: [
                    Dispute::from(
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
                    Refund::from(
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
        $result = $this->client->yourWebhookURL->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = YourWebhookURLCreateParams::from(
            businessID: 'business_id',
            data: Payment::from(
                billing: BillingAddress::from(
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
                customer: CustomerLimitedDetails::from(
                    customerID: 'customer_id',
                    email: 'email',
                    name: 'name'
                ),
                digitalProductsDelivered: true,
                disputes: [
                    Dispute::from(
                        amount: 'amount',
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        currency: 'currency',
                        disputeID: 'dispute_id',
                        disputeStage: DisputeStage::PRE_DISPUTE,
                        disputeStatus: DisputeStatus::DISPUTE_OPENED,
                        paymentID: 'payment_id',
                    )
                        ->setRemarks('remarks'),
                ],
                metadata: ['foo' => 'string'],
                paymentID: 'payment_id',
                refunds: [
                    Refund::from(
                        businessID: 'business_id',
                        createdAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        isPartial: true,
                        paymentID: 'payment_id',
                        refundID: 'refund_id',
                        status: RefundStatus::SUCCEEDED,
                    )
                        ->setAmount(0)
                        ->setCurrency(Currency::AED)
                        ->setReason('reason'),
                ],
                settlementAmount: 0,
                settlementCurrency: Currency::AED,
                totalAmount: 0,
                payloadType: 'Payment',
            )
                ->setCardIssuingCountry(CountryCode::AF)
                ->setCardLastFour('card_last_four')
                ->setCardNetwork('card_network')
                ->setCardType('card_type')
                ->setDiscountID('discount_id')
                ->setErrorCode('error_code')
                ->setErrorMessage('error_message')
                ->setPaymentLink('payment_link')
                ->setPaymentMethod('payment_method')
                ->setPaymentMethodType('payment_method_type')
                ->setProductCart(
                    [ProductCart::from(productID: 'product_id', quantity: 0)]
                )
                ->setSettlementTax(0)
                ->setStatus(IntentStatus::SUCCEEDED)
                ->setSubscriptionID('subscription_id')
                ->setTax(0)
                ->setUpdatedAt(new \DateTimeImmutable('2019-12-27T18:11:19.117Z')),
            timestamp: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            type: WebhookEventType::PAYMENT_SUCCEEDED,
            webhookID: 'webhook-id',
            webhookSignature: 'webhook-signature',
            webhookTimestamp: 'webhook-timestamp',
        );
        $result = $this->client->yourWebhookURL->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
