<?php

namespace Tests\Services\ProductCollections;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Misc\Locale;
use Dodopayments\Products\Translations\Translation;
use Dodopayments\Products\Translations\TranslationsListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class TranslationsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(bearerToken: 'My Bearer Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->productCollections->translations->update(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Translation::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->productCollections->translations->update(
            Locale::AR,
            id: 'id',
            description: 'description',
            name: 'name'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Translation::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->productCollections->translations->list('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(TranslationsListResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->productCollections->translations->delete(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->productCollections->translations->delete(
            Locale::AR,
            id: 'id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
