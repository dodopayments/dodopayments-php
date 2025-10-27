<?php

namespace Tests\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\ProductCart;
use Dodopayments\Client;
use Dodopayments\Subscriptions\AttachAddon;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CheckoutSessionsTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->checkoutSessions->create(
            productCart: [ProductCart::with(productID: 'product_id', quantity: 0)]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->checkoutSessions->create(
            productCart: [
                ProductCart::with(productID: 'product_id', quantity: 0)
                    ->withAddons([AttachAddon::with(addonID: 'addon_id', quantity: 0)])
                    ->withAmount(0),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->checkoutSessions->retrieve('id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
