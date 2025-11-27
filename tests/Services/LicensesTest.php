<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\Licenses\LicenseActivateResponse;
use Dodopayments\Licenses\LicenseValidateResponse;
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
        $result = $this->client->licenses->activate([
            'license_key' => 'license_key', 'name' => 'name',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseActivateResponse::class, $result);
    }

    #[Test]
    public function testActivateWithOptionalParams(): void
    {
        $result = $this->client->licenses->activate([
            'license_key' => 'license_key', 'name' => 'name',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseActivateResponse::class, $result);
    }

    #[Test]
    public function testDeactivate(): void
    {
        $result = $this->client->licenses->deactivate([
            'license_key' => 'license_key',
            'license_key_instance_id' => 'license_key_instance_id',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeactivateWithOptionalParams(): void
    {
        $result = $this->client->licenses->deactivate([
            'license_key' => 'license_key',
            'license_key_instance_id' => 'license_key_instance_id',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testValidate(): void
    {
        $result = $this->client->licenses->validate([
            'license_key' => '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseValidateResponse::class, $result);
    }

    #[Test]
    public function testValidateWithOptionalParams(): void
    {
        $result = $this->client->licenses->validate([
            'license_key' => '2b1f8e2d-c41e-4e8f-b2d3-d9fd61c38f43',
            'license_key_instance_id' => 'lki_123',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseValidateResponse::class, $result);
    }
}
