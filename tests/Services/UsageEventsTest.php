<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\UsageEvents\EventInput;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class UsageEventsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->usageEvents->retrieve('event_id');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->usageEvents->list();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testIngest(): void
    {
        $result = $this->client->usageEvents->ingest(
            [
                EventInput::with(
                    customerID: 'customer_id',
                    eventID: 'event_id',
                    eventName: 'event_name',
                ),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testIngestWithOptionalParams(): void
    {
        $result = $this->client->usageEvents->ingest(
            [
                EventInput::with(
                    customerID: 'customer_id',
                    eventID: 'event_id',
                    eventName: 'event_name',
                )
                    ->withMetadata(['foo' => 'string'])
                    ->withTimestamp(new \DateTimeImmutable('2019-12-27T18:11:19.117Z')),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
