<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\CbbOverageBehavior;
use Dodopayments\CreditEntitlements\CreditEntitlement;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Subscriptions\TimeInterval;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CreditEntitlementsTest extends TestCase
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
        $result = $this->client->creditEntitlements->create(
            name: 'name',
            overageEnabled: true,
            precision: 0,
            rolloverEnabled: true,
            unit: 'unit',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreditEntitlement::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->creditEntitlements->create(
            name: 'name',
            overageEnabled: true,
            precision: 0,
            rolloverEnabled: true,
            unit: 'unit',
            currency: Currency::AED,
            description: 'description',
            expiresAfterDays: 0,
            maxRolloverCount: 0,
            overageBehavior: CbbOverageBehavior::FORGIVE_AT_RESET,
            overageLimit: 0,
            pricePerUnit: 'price_per_unit',
            rolloverPercentage: 0,
            rolloverTimeframeCount: 0,
            rolloverTimeframeInterval: TimeInterval::DAY,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreditEntitlement::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->creditEntitlements->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreditEntitlement::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->creditEntitlements->update('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->creditEntitlements->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CreditEntitlement::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->creditEntitlements->delete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUndelete(): void
    {
        $result = $this->client->creditEntitlements->undelete('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
