<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\SubscriptionsContract;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams;
use Dodopayments\Subscriptions\SubscriptionChargeParams;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionCreateParams;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionRetrieveUsageHistoryParams;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdateParams;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;

final class SubscriptionsService implements SubscriptionsContract
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
     *     city: string,
     *     country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *     state: string,
     *     street: string,
     *     zipcode: string,
     *   }|BillingAddress,
     *   customer: array<string,mixed>,
     *   product_id: string,
     *   quantity: int,
     *   addons?: list<array{addon_id: string, quantity: int}>|null,
     *   allowed_payment_method_types?: list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null,
     *   billing_currency?: value-of<Currency>,
     *   discount_code?: string|null,
     *   force_3ds?: bool|null,
     *   metadata?: array<string,string>,
     *   on_demand?: array{
     *     mandate_only: bool,
     *     adaptive_currency_fees_inclusive?: bool|null,
     *     product_currency?: 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null,
     *     product_description?: string|null,
     *     product_price?: int|null,
     *   }|null,
     *   payment_link?: bool|null,
     *   return_url?: string|null,
     *   show_saved_payment_methods?: bool,
     *   tax_id?: string|null,
     *   trial_period_days?: int|null,
     * }|SubscriptionCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|SubscriptionCreateParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse {
        [$parsed, $options] = SubscriptionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: 'subscriptions',
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionNewResponse::class,
        );
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s', $subscriptionID],
            options: $requestOptions,
            convert: Subscription::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   billing?: array{
     *     city: string,
     *     country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *     state: string,
     *     street: string,
     *     zipcode: string,
     *   }|BillingAddress|null,
     *   cancel_at_next_billing_date?: bool|null,
     *   customer_name?: string|null,
     *   disable_on_demand?: array{next_billing_date: string|\DateTimeInterface}|null,
     *   metadata?: array<string,string>|null,
     *   next_billing_date?: string|\DateTimeInterface|null,
     *   status?: 'pending'|'active'|'on_hold'|'cancelled'|'failed'|'expired'|SubscriptionStatus|null,
     *   tax_id?: string|null,
     * }|SubscriptionUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|SubscriptionUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): Subscription {
        [$parsed, $options] = SubscriptionUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'patch',
            path: ['subscriptions/%1$s', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: Subscription::class,
        );
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
     *   status?: 'pending'|'active'|'on_hold'|'cancelled'|'failed'|'expired',
     * }|SubscriptionListParams $params
     *
     * @return DefaultPageNumberPagination<SubscriptionListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|SubscriptionListParams $params,
        ?RequestOptions $requestOptions = null
    ): DefaultPageNumberPagination {
        [$parsed, $options] = SubscriptionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'subscriptions',
            query: $parsed,
            options: $options,
            convert: SubscriptionListResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   product_id: string,
     *   proration_billing_mode: 'prorated_immediately'|'full_immediately'|'difference_immediately',
     *   quantity: int,
     *   addons?: list<array{addon_id: string, quantity: int}>|null,
     * }|SubscriptionChangePlanParams $params
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        array|SubscriptionChangePlanParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = SubscriptionChangePlanParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/change-plan', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * @param array{
     *   product_price: int,
     *   adaptive_currency_fees_inclusive?: bool|null,
     *   customer_balance_config?: array{
     *     allow_customer_credits_purchase?: bool|null,
     *     allow_customer_credits_usage?: bool|null,
     *   }|null,
     *   metadata?: array<string,string>|null,
     *   product_currency?: value-of<Currency>,
     *   product_description?: string|null,
     * }|SubscriptionChargeParams $params
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        array|SubscriptionChargeParams $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse {
        [$parsed, $options] = SubscriptionChargeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/charge', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionChargeResponse::class,
        );
    }

    /**
     * @api
     *
     * Get detailed usage history for a subscription that includes usage-based billing (metered components).
     * This endpoint provides insights into customer usage patterns and billing calculations over time.
     *
     * ## What You'll Get:
     * - **Billing periods**: Each item represents a billing cycle with start and end dates
     * - **Meter usage**: Detailed breakdown of usage for each meter configured on the subscription
     * - **Usage calculations**: Total units consumed, free threshold units, and chargeable units
     * - **Historical tracking**: Complete audit trail of usage-based charges
     *
     * ## Use Cases:
     * - **Customer support**: Investigate billing questions and usage discrepancies
     * - **Usage analytics**: Analyze customer consumption patterns over time
     * - **Billing transparency**: Provide customers with detailed usage breakdowns
     * - **Revenue optimization**: Identify usage trends to optimize pricing strategies
     *
     * ## Filtering Options:
     * - **Date range filtering**: Get usage history for specific time periods
     * - **Meter-specific filtering**: Focus on usage for a particular meter
     * - **Pagination**: Navigate through large usage histories efficiently
     *
     * ## Important Notes:
     * - Only returns data for subscriptions with usage-based (metered) components
     * - Usage history is organized by billing periods (subscription cycles)
     * - Free threshold units are calculated and displayed separately from chargeable units
     * - Historical data is preserved even if meter configurations change
     *
     * ## Example Query Patterns:
     * - Get last 3 months: `?start_date=2024-01-01T00:00:00Z&end_date=2024-03-31T23:59:59Z`
     * - Filter by meter: `?meter_id=mtr_api_requests`
     * - Paginate results: `?page_size=20&page_number=1`
     * - Recent usage: `?start_date=2024-03-01T00:00:00Z` (from March 1st to now)
     *
     * @param array{
     *   end_date?: string|\DateTimeInterface|null,
     *   meter_id?: string|null,
     *   page_number?: int|null,
     *   page_size?: int|null,
     *   start_date?: string|\DateTimeInterface|null,
     * }|SubscriptionRetrieveUsageHistoryParams $params
     *
     * @return DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        array|SubscriptionRetrieveUsageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination {
        [$parsed, $options] = SubscriptionRetrieveUsageHistoryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['subscriptions/%1$s/usage-history', $subscriptionID],
            query: $parsed,
            options: $options,
            convert: SubscriptionGetUsageHistoryResponse::class,
            page: DefaultPageNumberPagination::class,
        );
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function updatePaymentMethod(
        string $subscriptionID,
        mixed $params,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionUpdatePaymentMethodResponse {
        [$parsed, $options] = SubscriptionUpdatePaymentMethodParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['subscriptions/%1$s/update-payment-method', $subscriptionID],
            body: (object) $parsed,
            options: $options,
            convert: SubscriptionUpdatePaymentMethodResponse::class,
        );
    }
}
