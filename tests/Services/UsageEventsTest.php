<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\UsageEvents\Event;
use Dodopayments\UsageEvents\UsageEventIngestResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->usageEvents->retrieve('event_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Event::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->usageEvents->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Event::class, $item);
        }
    }

    #[Test]
    public function testIngest(): void
    {
        $result = $this->client->usageEvents->ingest(
            events: [
                [
                    'customerID' => 'customer_id',
                    'eventID' => 'event_id',
                    'eventName' => 'event_name',
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UsageEventIngestResponse::class, $result);
    }

    #[Test]
    public function testIngestWithOptionalParams(): void
    {
        $result = $this->client->usageEvents->ingest(
            events: [
                [
                    'customerID' => 'customer_id',
                    'eventID' => 'event_id',
                    'eventName' => 'event_name',
                    'metadata' => ['foo' => 'string'],
                    'timestamp' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UsageEventIngestResponse::class, $result);
    }
}
