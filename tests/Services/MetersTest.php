<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Meters\MeterAggregation;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

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
            aggregation: MeterAggregation::with(type: 'count'),
            eventName: 'event_name',
            measurementUnit: 'measurement_unit',
            name: 'name',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->meters->create(
            aggregation: MeterAggregation::with(type: 'count')->withKey('key'),
            eventName: 'event_name',
            measurementUnit: 'measurement_unit',
            name: 'name',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->meters->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->meters->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->meters->delete('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUnarchive(): void
    {
        $result = $this->client->meters->unarchive('id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
