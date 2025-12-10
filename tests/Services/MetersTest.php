<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Meters\Meter;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class MetersTest extends TestCase
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
        $result = $this->client->meters->create(
            aggregation: ['type' => 'count'],
            eventName: 'event_name',
            measurementUnit: 'measurement_unit',
            name: 'name',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Meter::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->meters->create(
            aggregation: ['type' => 'count', 'key' => 'key'],
            eventName: 'event_name',
            measurementUnit: 'measurement_unit',
            name: 'name',
            description: 'description',
            filter: [
                'clauses' => [
                    ['key' => 'user_id', 'operator' => 'equals', 'value' => 'user123'],
                    ['key' => 'amount', 'operator' => 'greater_than', 'value' => 100],
                ],
                'conjunction' => 'and',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Meter::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->meters->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Meter::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->meters->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->meters->archive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->meters->unarchive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
