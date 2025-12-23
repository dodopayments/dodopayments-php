<?php

namespace Tests\Services\Products;

use Dodopayments\Client;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Products\ShortLinks\ShortLinkListResponse;
use Dodopayments\Products\ShortLinks\ShortLinkNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ShortLinksTest extends TestCase
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
        $result = $this->client->products->shortLinks->create('id', slug: 'slug');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ShortLinkNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->products->shortLinks->create(
            'id',
            slug: 'slug',
            staticCheckoutParams: ['foo' => 'string']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ShortLinkNewResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->products->shortLinks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(ShortLinkListResponse::class, $item);
        }
    }
}
