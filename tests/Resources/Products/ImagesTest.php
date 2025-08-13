<?php

namespace Tests\Resources\Products;

use DodoPayments\Client;
use DodoPayments\Products\Images\ImageUpdateParams;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ImagesTest extends TestCase
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
    public function testUpdate(): void
    {
        $params = (new ImageUpdateParams);
        $result = $this->client->products->images->update('id', $params);

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
