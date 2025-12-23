<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
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
use Dodopayments\ServiceContracts\PaymentsRawContract;

final class PaymentsRawService implements PaymentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @deprecated
     *
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
     *   productCart: list<array{
     *     productID: string, quantity: int, amount?: int|null
     *   }|OneTimeProductCartItem>,
     *   allowedPaymentMethodTypes?: list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null,
     *   billingCurrency?: value-of<Currency>,
     *   discountCode?: string|null,
     *   force3DS?: bool|null,
     *   metadata?: array<string,string>,
     *   paymentLink?: bool|null,
     *   paymentMethodID?: string|null,
     *   redirectImmediately?: bool,
     *   returnURL?: string|null,
     *   shortLink?: bool|null,
     *   showSavedPaymentMethods?: bool,
     *   taxID?: string|null,
     * }|PaymentCreateParams $params
     *
     * @return BaseResponse<PaymentNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PaymentCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = PaymentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'payments',
            body: (object) $parsed,
            options: $options,
            convert: PaymentNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @return BaseResponse<Payment>
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/%1$s', $paymentID],
            options: $requestOptions,
            convert: Payment::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   brandID?: string,
     *   createdAtGte?: string|\DateTimeInterface,
     *   createdAtLte?: string|\DateTimeInterface,
     *   customerID?: string,
     *   pageNumber?: int,
     *   pageSize?: int,
     *   status?: value-of<Status>,
     *   subscriptionID?: string,
     * }|PaymentListParams $params
     *
     * @return BaseResponse<DefaultPageNumberPagination<PaymentListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PaymentListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = PaymentListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'payments',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'brandID' => 'brand_id',
                    'createdAtGte' => 'created_at_gte',
                    'createdAtLte' => 'created_at_lte',
                    'customerID' => 'customer_id',
                    'pageNumber' => 'page_number',
                    'pageSize' => 'page_size',
                    'subscriptionID' => 'subscription_id',
                ],
            ),
            options: $options,
            convert: PaymentListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @return BaseResponse<PaymentGetLineItemsResponse>
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['payments/%1$s/line-items', $paymentID],
            options: $requestOptions,
            convert: PaymentGetLineItemsResponse::class,
        );
    }
}
