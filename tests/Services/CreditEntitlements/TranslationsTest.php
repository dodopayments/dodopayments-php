<?php

namespace Tests\Services\CreditEntitlements;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslation;
use Dodopayments\CreditEntitlements\Translations\CreditEntitlementTranslationsListResponse;
use Dodopayments\Misc\Locale;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class TranslationsTest extends TestCase
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
    public function testUpdate(): void
    {
        $result = $this->client->creditEntitlements->translations->update(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreditEntitlementTranslation::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->creditEntitlements->translations->update(
            Locale::AR,
            id: 'id',
            name: 'name',
            unit: 'unit'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CreditEntitlementTranslation::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->creditEntitlements->translations->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            CreditEntitlementTranslationsListResponse::class,
            $result
        );
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->creditEntitlements->translations->delete(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->creditEntitlements->translations->delete(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
