<?php

namespace Tests\Resources;

use DodopaymentsClient\Client;
use DodopaymentsClient\Refunds\RefundCreateParams;
use DodopaymentsClient\Refunds\RefundCreateParams\Item;
use DodopaymentsClient\Refunds\RefundListParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class RefundsTest extends TestCase
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
        $params = RefundCreateParams::from(paymentID: 'payment_id');
        $result = $this->client->refunds->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = RefundCreateParams::from(
            paymentID: 'payment_id',
            items: [
                Item::from(itemID: 'item_id')->setAmount(0)->setTaxInclusive(true),
            ],
            reason: 'reason',
        );
        $result = $this->client->refunds->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->refunds->retrieve('refund_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new RefundListParams);
        $result = $this->client->refunds->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
