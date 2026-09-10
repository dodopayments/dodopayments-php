<?php

namespace Tests\Services\Customers;

use Dodopayments\Client;
use Dodopayments\Core\Util;
use Dodopayments\Customers\Emails\EmailBody;
use Dodopayments\Customers\Emails\EmailLogItem;
use Dodopayments\DefaultPageNumberPagination;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EmailsTest extends TestCase
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
    public function testList(): void
    {
        $page = $this->client->customers->emails->list('customer_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DefaultPageNumberPagination::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EmailLogItem::class, $item);
        }
    }

    #[Test]
    public function testRetrieveBody(): void
    {
        $result = $this->client->customers->emails->retrieveBody(
            'email_log_id',
            customerID: 'customer_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EmailBody::class, $result);
    }

    #[Test]
    public function testRetrieveBodyWithOptionalParams(): void
    {
        $result = $this->client->customers->emails->retrieveBody(
            'email_log_id',
            customerID: 'customer_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EmailBody::class, $result);
    }
}
