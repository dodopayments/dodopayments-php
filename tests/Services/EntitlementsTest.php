<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\EntitlementGetResponse;
use Dodopayments\Entitlements\EntitlementListResponse;
use Dodopayments\Entitlements\EntitlementNewResponse;
use Dodopayments\Entitlements\EntitlementUpdateResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EntitlementsTest extends TestCase
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
        $result = $this->client->entitlements->create(
            integrationConfig: [
                'permission' => 'permission', 'targetID' => 'target_id',
            ],
            integrationType: 'discord',
            name: 'name',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitlementNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->entitlements->create(
            integrationConfig: [
                'permission' => 'permission', 'targetID' => 'target_id',
            ],
            integrationType: 'discord',
            name: 'name',
            description: 'description',
            metadata: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitlementNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->entitlements->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitlementGetResponse::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->entitlements->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntitlementUpdateResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->entitlements->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntitlementListResponse::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->entitlements->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
