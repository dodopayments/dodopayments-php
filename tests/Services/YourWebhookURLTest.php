<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Disputes\DisputeStage;
use Dodopayments\Disputes\DisputeStatus;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\IntentStatus;
use Dodopayments\Payments\PaymentRefundStatus;
use Dodopayments\Refunds\RefundStatus;
use Dodopayments\WebhookEvents\WebhookEventType;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->yourWebhookURL->create(
            businessID: 'business_id',
            data: [
                'billing' => ['country' => CountryCode::AF],
                'brandID' => 'brand_id',
                'businessID' => 'business_id',
                'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'currency' => Currency::AED,
                'customer' => [
                    'customerID' => 'customer_id', 'email' => 'email', 'name' => 'name',
                ],
                'digitalProductsDelivered' => true,
                'disputes' => [
                    [
                        'amount' => 'amount',
                        'businessID' => 'business_id',
                        'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        'currency' => 'currency',
                        'disputeID' => 'dispute_id',
                        'disputeStage' => DisputeStage::PRE_DISPUTE,
                        'disputeStatus' => DisputeStatus::DISPUTE_OPENED,
                        'paymentID' => 'payment_id',
                    ],
                ],
                'metadata' => ['foo' => 'string'],
                'paymentID' => 'payment_id',
                'refunds' => [
                    [
                        'businessID' => 'business_id',
                        'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        'isPartial' => true,
                        'paymentID' => 'payment_id',
                        'refundID' => 'refund_id',
                        'status' => RefundStatus::SUCCEEDED,
                    ],
                ],
                'settlementAmount' => 0,
                'settlementCurrency' => Currency::AED,
                'totalAmount' => 0,
                'payloadType' => 'Payment',
            ],
            timestamp: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            type: WebhookEventType::PAYMENT_SUCCEEDED,
            webhookID: 'webhook-id',
            webhookSignature: 'webhook-signature',
            webhookTimestamp: 'webhook-timestamp',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->yourWebhookURL->create(
            businessID: 'business_id',
            data: [
                'billing' => [
                    'country' => CountryCode::AF,
                    'city' => 'city',
                    'state' => 'state',
                    'street' => 'street',
                    'zipcode' => 'zipcode',
                ],
                'brandID' => 'brand_id',
                'businessID' => 'business_id',
                'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'currency' => Currency::AED,
                'customer' => [
                    'customerID' => 'customer_id',
                    'email' => 'email',
                    'name' => 'name',
                    'metadata' => ['foo' => 'string'],
                    'phoneNumber' => 'phone_number',
                ],
                'digitalProductsDelivered' => true,
                'disputes' => [
                    [
                        'amount' => 'amount',
                        'businessID' => 'business_id',
                        'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        'currency' => 'currency',
                        'disputeID' => 'dispute_id',
                        'disputeStage' => DisputeStage::PRE_DISPUTE,
                        'disputeStatus' => DisputeStatus::DISPUTE_OPENED,
                        'paymentID' => 'payment_id',
                        'remarks' => 'remarks',
                    ],
                ],
                'metadata' => ['foo' => 'string'],
                'paymentID' => 'payment_id',
                'refunds' => [
                    [
                        'businessID' => 'business_id',
                        'createdAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                        'isPartial' => true,
                        'paymentID' => 'payment_id',
                        'refundID' => 'refund_id',
                        'status' => RefundStatus::SUCCEEDED,
                        'amount' => 0,
                        'currency' => Currency::AED,
                        'reason' => 'reason',
                    ],
                ],
                'settlementAmount' => 0,
                'settlementCurrency' => Currency::AED,
                'totalAmount' => 0,
                'cardHolderName' => 'card_holder_name',
                'cardIssuingCountry' => CountryCode::AF,
                'cardLastFour' => 'card_last_four',
                'cardNetwork' => 'card_network',
                'cardType' => 'card_type',
                'checkoutSessionID' => 'checkout_session_id',
                'customFieldResponses' => [['key' => 'key', 'value' => 'value']],
                'discountID' => 'discount_id',
                'errorCode' => 'error_code',
                'errorMessage' => 'error_message',
                'invoiceID' => 'invoice_id',
                'invoiceURL' => 'invoice_url',
                'paymentLink' => 'payment_link',
                'paymentMethod' => 'payment_method',
                'paymentMethodType' => 'payment_method_type',
                'productCart' => [['productID' => 'product_id', 'quantity' => 0]],
                'refundStatus' => PaymentRefundStatus::PARTIAL,
                'settlementTax' => 0,
                'status' => IntentStatus::SUCCEEDED,
                'subscriptionID' => 'subscription_id',
                'tax' => 0,
                'updatedAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'payloadType' => 'Payment',
            ],
            timestamp: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            type: WebhookEventType::PAYMENT_SUCCEEDED,
            webhookID: 'webhook-id',
            webhookSignature: 'webhook-signature',
            webhookTimestamp: 'webhook-timestamp',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
