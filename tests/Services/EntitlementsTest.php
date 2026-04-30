<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Entitlements\Entitlement;
use Dodopayments\Entitlements\EntitlementIntegrationType;
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
            integrationType: EntitlementIntegrationType::DISCORD,
            name: 'name',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entitlement::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->entitlements->create(
            integrationConfig: [
                'permission' => 'permission', 'targetID' => 'target_id',
            ],
            integrationType: EntitlementIntegrationType::DISCORD,
            name: 'name',
            description: 'description',
            metadata: ['foo' => 'string'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entitlement::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->entitlements->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entitlement::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->entitlements->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entitlement::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->entitlements->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Entitlement::class, $item);
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
