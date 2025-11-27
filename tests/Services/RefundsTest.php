<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
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
        $result = $this->client->refunds->create(['payment_id' => 'payment_id']);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Refund::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->refunds->create([
            'payment_id' => 'payment_id',
            'items' => [
                ['item_id' => 'item_id', 'amount' => 0, 'tax_inclusive' => true],
            ],
            'metadata' => ['foo' => 'string'],
            'reason' => 'reason',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Refund::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->refunds->retrieve('refund_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Refund::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->refunds->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }
}
