<?php

namespace Tests\Services;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

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

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseKeyInstance::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->licenseKeyInstances->update(
            'lki_123',
            ['name' => 'name']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseKeyInstance::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->licenseKeyInstances->update(
            'lki_123',
            ['name' => 'name']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LicenseKeyInstance::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->licenseKeyInstances->list([]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $result);
    }
}
