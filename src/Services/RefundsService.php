<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Implementation\HasRawResponse;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Refunds\Refund;
use Dodopayments\Refunds\RefundCreateParams;
use Dodopayments\Refunds\RefundCreateParams\Item;
use Dodopayments\Refunds\RefundListParams;
use Dodopayments\Refunds\RefundListParams\Status;
use Dodopayments\Refunds\RefundListResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\RefundsContract;

use const Dodopayments\Core\OMIT as omit;

final class RefundsService implements RefundsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $paymentID the unique identifier of the payment to be refunded
     * @param list<Item>|null $items Partially Refund an Individual Item
     * @param string|null $reason The reason for the refund, if any. Maximum length is 3000 characters. Optional.
     *
     * @return Refund<HasRawResponse>
     *
     * @throws APIException
     */
    public function create(
        $paymentID,
        $items = omit,
        $reason = omit,
        ?RequestOptions $requestOptions = null,
    ): Refund {
        $params = [
            'paymentID' => $paymentID, 'items' => $items, 'reason' => $reason,
        ];

        return $this->createRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return Refund<HasRawResponse>
     *
     * @throws APIException
     */
    public function createRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): Refund {
        [$parsed, $options] = RefundCreateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'refunds',
            body: (object) $parsed,
            options: $options,
            convert: Refund::class,
        );
    }

    /**
     * @api
     *
     * @return Refund<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $refundID,
        ?RequestOptions $requestOptions = null
    ): Refund {
        $params = [];

        return $this->retrieveRaw($refundID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return Refund<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $refundID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): Refund {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['refunds/%1$s', $refundID],
            options: $requestOptions,
            convert: Refund::class,
        );
    }

    /**
     * @api
     *
     * @param \DateTimeInterface $createdAtGte Get events after this created time
     * @param \DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer_id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param Status|value-of<Status> $status Filter by status
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function list(
        $createdAtGte = omit,
        $createdAtLte = omit,
        $customerID = omit,
        $pageNumber = omit,
        $pageSize = omit,
        $status = omit,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = [
            'createdAtGte' => $createdAtGte,
            'createdAtLte' => $createdAtLte,
            'customerID' => $customerID,
            'pageNumber' => $pageNumber,
            'pageSize' => $pageSize,
            'status' => $status,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return DefaultPageNumberPagination<RefundListResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = RefundListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'refunds',
            query: $parsed,
            options: $options,
            convert: RefundListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }
}
