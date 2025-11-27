<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeys\LicenseKey;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LicenseKeysTest extends TestCase
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
        $result = $this->client->licenseKeys->retrieve('lic_123');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseKey::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->licenseKeys->update('lic_123', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseKey::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->licenseKeys->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }
}
