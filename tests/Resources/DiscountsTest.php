<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\Discounts\DiscountCreateParams;
use Dodopayments\Discounts\DiscountListParams;
use Dodopayments\Discounts\DiscountType;
use Dodopayments\Discounts\DiscountUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class DiscountsTest extends TestCase
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
        $params = DiscountCreateParams::with(
            amount: 0,
            type: DiscountType::PERCENTAGE
        );
        $result = $this->client->discounts->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $params = DiscountCreateParams::with(
            amount: 0,
            type: DiscountType::PERCENTAGE,
            code: 'code',
            expiresAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            name: 'name',
            restrictedTo: ['string'],
            subscriptionCycles: 0,
            usageLimit: 0,
        );
        $result = $this->client->discounts->create($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->discounts->retrieve('discount_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new DiscountUpdateParams);
        $result = $this->client->discounts->update('discount_id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new DiscountListParams);
        $result = $this->client->discounts->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->discounts->delete('discount_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
