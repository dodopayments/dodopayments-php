<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams;
use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
use Dodopayments\Core\Contracts\BaseResponse;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsContract;

final class CheckoutSessionsService implements CheckoutSessionsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   product_cart: list<array{
     *     product_id: string,
     *     quantity: int,
     *     addons?: list<array<mixed>>|null,
     *     amount?: int|null,
     *   }>,
     *   allowed_payment_method_types?: list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null,
     *   billing_address?: array{
     *     country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *     city?: string|null,
     *     state?: string|null,
     *     street?: string|null,
     *     zipcode?: string|null,
     *   }|null,
     *   billing_currency?: value-of<Currency>,
     *   confirm?: bool,
     *   customer?: array<string,mixed>|null,
     *   customization?: array{
     *     force_language?: string|null,
     *     show_on_demand_tag?: bool,
     *     show_order_details?: bool,
     *     theme?: 'dark'|'light'|'system'|Theme,
     *   },
     *   discount_code?: string|null,
     *   feature_flags?: array{
     *     allow_currency_selection?: bool,
     *     allow_customer_editing_city?: bool,
     *     allow_customer_editing_country?: bool,
     *     allow_customer_editing_email?: bool,
     *     allow_customer_editing_name?: bool,
     *     allow_customer_editing_state?: bool,
     *     allow_customer_editing_street?: bool,
     *     allow_customer_editing_zipcode?: bool,
     *     allow_discount_code?: bool,
     *     allow_phone_number_collection?: bool,
     *     allow_tax_id?: bool,
     *     always_create_new_customer?: bool,
     *   },
     *   force_3ds?: bool|null,
     *   metadata?: array<string,string>|null,
     *   minimal_address?: bool,
     *   return_url?: string|null,
     *   show_saved_payment_methods?: bool,
     *   subscription_data?: array{
     *     on_demand?: array{
     *       mandate_only: bool,
     *       adaptive_currency_fees_inclusive?: bool|null,
     *       product_currency?: 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null,
     *       product_description?: string|null,
     *       product_price?: int|null,
     *     }|null,
     *     trial_period_days?: int|null,
     *   }|null,
     * }|CheckoutSessionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|CheckoutSessionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckoutSessionResponse {
        [$parsed, $options] = CheckoutSessionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<CheckoutSessionResponse> */
        $response = $this->client->request(
            method: 'post',
            path: 'checkouts',
            body: (object) $parsed,
            options: $options,
            convert: CheckoutSessionResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): CheckoutSessionStatus {
        /** @var BaseResponse<CheckoutSessionStatus> */
        $response = $this->client->request(
            method: 'get',
            path: ['checkouts/%1$s', $id],
            options: $requestOptions,
            convert: CheckoutSessionStatus::class,
        );

        return $response->parse();
    }
}
