<?php

namespace Tests\Resources;

use Dodopayments\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LicensesTest extends TestCase
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
    public function testActivate(): void
    {
        $result = $this->client->licenses->activate(
            licenseKey: 'license_key',
            name: 'name'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testActivateWithOptionalParams(): void
    {
        $result = $this->client->licenses->activate(
            licenseKey: 'license_key',
            name: 'name'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeactivate(): void
    {
        $result = $this->client->licenses->deactivate(
            licenseKey: 'license_key',
            licenseKeyInstanceID: 'license_key_instance_id'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeactivateWithOptionalParams(): void
    {
        $result = $this->client->licenses->deactivate(
            licenseKey: 'license_key',
            licenseKeyInstanceID: 'license_key_instance_id'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidate(): void
    {
        $result = $this->client->licenses->validate(
            licenseKey: '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43'
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateWithOptionalParams(): void
    {
        $result = $this->client->licenses->validate(
            licenseKey: '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43',
            licenseKeyInstanceID: 'lki_123',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
