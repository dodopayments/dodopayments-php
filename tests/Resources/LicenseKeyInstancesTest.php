<?php

namespace Tests\Resources;

use Dodopayments\Client;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceListParams;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstanceUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class LicenseKeyInstancesTest extends TestCase
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
        $result = $this->client->licenseKeyInstances->retrieve('lki_123');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdate(): void
    {
        $params = LicenseKeyInstanceUpdateParams::with(name: 'name');
        $result = $this->client->licenseKeyInstances->update('lki_123', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $params = LicenseKeyInstanceUpdateParams::with(name: 'name');
        $result = $this->client->licenseKeyInstances->update('lki_123', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $params = (new LicenseKeyInstanceListParams);
        $result = $this->client->licenseKeyInstances->list($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
