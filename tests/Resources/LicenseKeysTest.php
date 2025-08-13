<?php

namespace Tests\Resources;

use DodoPayments\Client;
use DodoPayments\LicenseKeys\LicenseKeyListParams;
use DodoPayments\LicenseKeys\LicenseKeyUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

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

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = (new LicenseKeyUpdateParams);
        $result = $this->client->licenseKeys->update('lic_123', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new LicenseKeyListParams);
        $result = $this->client->licenseKeys->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
