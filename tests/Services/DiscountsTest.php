<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Discounts\Discount;
use Dodopayments\Discounts\DiscountType;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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
        $result = $this->client->discounts->create(
            amount: 0,
            type: DiscountType::PERCENTAGE
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Discount::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->discounts->create(
            amount: 0,
            type: DiscountType::PERCENTAGE,
            code: 'code',
            expiresAt: new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            name: 'name',
            restrictedTo: ['string'],
            subscriptionCycles: 0,
            usageLimit: 0,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Discount::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->discounts->retrieve('discount_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Discount::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->discounts->update('discount_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Discount::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->discounts->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Discount::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->discounts->delete('discount_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
