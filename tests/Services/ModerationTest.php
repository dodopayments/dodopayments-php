<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Moderation\ModerationGetUsageResponse;
use Dodopayments\Moderation\ModerationScreenResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ModerationTest extends TestCase
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
    public function testRetrieveUsage(): void
    {
        $result = $this->client->moderation->retrieveUsage();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ModerationGetUsageResponse::class, $result);
    }

    #[Test]
    public function testScreen(): void
    {
        $result = $this->client->moderation->screen();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ModerationScreenResponse::class, $result);
    }
}
