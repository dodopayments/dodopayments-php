<?php

namespace Tests\Resources;

use DodoPayments\Client;
use DodoPayments\Licenses\LicenseActivateParams;
use DodoPayments\Licenses\LicenseDeactivateParams;
use DodoPayments\Licenses\LicenseValidateParams;
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
        $params = LicenseActivateParams::from(
            licenseKey: 'license_key',
            name: 'name'
        );
        $result = $this->client->licenses->activate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testActivateWithOptionalParams(): void
    {
        $params = LicenseActivateParams::from(
            licenseKey: 'license_key',
            name: 'name'
        );
        $result = $this->client->licenses->activate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeactivate(): void
    {
        $params = LicenseDeactivateParams::from(
            licenseKey: 'license_key',
            licenseKeyInstanceID: 'license_key_instance_id'
        );
        $result = $this->client->licenses->deactivate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDeactivateWithOptionalParams(): void
    {
        $params = LicenseDeactivateParams::from(
            licenseKey: 'license_key',
            licenseKeyInstanceID: 'license_key_instance_id'
        );
        $result = $this->client->licenses->deactivate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidate(): void
    {
        $params = LicenseValidateParams::from(
            licenseKey: '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43'
        );
        $result = $this->client->licenses->validate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testValidateWithOptionalParams(): void
    {
        $params = LicenseValidateParams::from(
            licenseKey: '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43',
            licenseKeyInstanceID: 'lki_123',
        );
        $result = $this->client->licenses->validate($params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
