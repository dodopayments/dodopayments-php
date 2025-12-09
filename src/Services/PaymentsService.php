<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentCreateParams;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\PaymentsContract;

final class PaymentsService implements PaymentsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   billing: array{
     *     country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *     city?: string|null,
     *     state?: string|null,
     *     street?: string|null,
     *     zipcode?: string|null,
     *   }|BillingAddress,
     *   customer: array<string,mixed>,
     *   product_cart: list<array{
     *     product_id: string, quantity: int, amount?: int|null
     *   }|OneTimeProductCartItem>,
     *   allowed_payment_method_types?: list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null,
     *   billing_currency?: value-of<Currency>,
     *   discount_code?: string|null,
     *   force_3ds?: bool|null,
     *   metadata?: array<string,string>,
     *   payment_link?: bool|null,
     *   return_url?: string|null,
     *   show_saved_payment_methods?: bool,
     *   tax_id?: string|null,
     * }|PaymentCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): PaymentNewResponse {
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<PaymentNewResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'payments',
            body: (object) $parsed,
            options: $options,
            convert: PaymentNewResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment {
        /** @var BaseResponse<Payment> */
        $response = $this->client->request(
            method: 'get',
            path: ['payments/%1$s', $paymentID],
            options: $requestOptions,
            convert: Payment::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{
     *   brand_id?: string,
     *   created_at_gte?: string|\DateTimeInterface,
     *   created_at_lte?: string|\DateTimeInterface,
     *   customer_id?: string,
     *   page_number?: int,
     *   page_size?: int,
     *   status?: value-of<Status>,
     *   subscription_id?: string,
     * }|PaymentListParams $params
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = PaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<DefaultPageNumberPagination<PaymentListResponse>> */
        $response = $this->client->request(
            method: 'get',
            path: 'payments',
            query: $parsed,
            options: $options,
            convert: PaymentListResponse::class,
            page: DefaultPageNumberPagination::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse {
        /** @var BaseResponse<PaymentGetLineItemsResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['payments/%1$s/line-items', $paymentID],
            options: $requestOptions,
            convert: PaymentGetLineItemsResponse::class,
        );

        return $response->parse();
    }
}
