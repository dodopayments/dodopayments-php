<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\Payment;
use Dodopayments\Payments\PaymentGetLineItemsResponse;
use Dodopayments\Payments\PaymentListParams\Status;
use Dodopayments\Payments\PaymentListResponse;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\Payments\PaymentNewResponse;
use Dodopayments\RequestOptions;

interface PaymentsContract
{
    /**
     * @deprecated
     *
     * @api
     *
     * @param array{
     *   country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|BillingAddress $billing Billing address details for the payment
     * @param array<string,mixed> $customer Customer information for the payment
     * @param list<array{
     *   productID: string, quantity: int, amount?: int|null
     * }|OneTimeProductCartItem> $productCart List of products in the cart. Must contain at least 1 and at most 100 items.
     * @param list<'ach'|'affirm'|'afterpay_clearpay'|'alfamart'|'ali_pay'|'ali_pay_hk'|'alma'|'amazon_pay'|'apple_pay'|'atome'|'bacs'|'bancontact_card'|'becs'|'benefit'|'bizum'|'blik'|'boleto'|'bca_bank_transfer'|'bni_va'|'bri_va'|'card_redirect'|'cimb_va'|'classic'|'credit'|'crypto_currency'|'cashapp'|'dana'|'danamon_va'|'debit'|'duit_now'|'efecty'|'eft'|'eps'|'fps'|'evoucher'|'giropay'|'givex'|'google_pay'|'go_pay'|'gcash'|'ideal'|'interac'|'indomaret'|'klarna'|'kakao_pay'|'local_bank_redirect'|'mandiri_va'|'knet'|'mb_way'|'mobile_pay'|'momo'|'momo_atm'|'multibanco'|'online_banking_thailand'|'online_banking_czech_republic'|'online_banking_finland'|'online_banking_fpx'|'online_banking_poland'|'online_banking_slovakia'|'oxxo'|'pago_efectivo'|'permata_bank_transfer'|'open_banking_uk'|'pay_bright'|'paypal'|'paze'|'pix'|'pay_safe_card'|'przelewy24'|'prompt_pay'|'pse'|'red_compra'|'red_pagos'|'samsung_pay'|'sepa'|'sepa_bank_transfer'|'sofort'|'swish'|'touch_n_go'|'trustly'|'twint'|'upi_collect'|'upi_intent'|'vipps'|'viet_qr'|'venmo'|'walley'|'we_chat_pay'|'seven_eleven'|'lawson'|'mini_stop'|'family_mart'|'seicomart'|'pay_easy'|'local_bank_transfer'|'mifinity'|'open_banking_pis'|'direct_carrier_billing'|'instant_bank_transfer'|'billie'|'zip'|'revolut_pay'|'naver_pay'|'payco'|PaymentMethodTypes>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the transaction
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this payment
     * @param array<string,string> $metadata Additional metadata associated with the payment.
     * Defaults to empty if not provided.
     * @param bool|null $paymentLink Whether to generate a payment link. Defaults to false if not specified.
     * @param string|null $paymentMethodID Optional payment method ID to use for this payment.
     * If provided, customer_id must also be provided.
     * The payment method will be validated for eligibility with the payment's currency.
     * @param bool $redirectImmediately If true, redirects the customer immediately after payment completion
     * False by default
     * @param string|null $returnURL Optional URL to redirect the customer after payment.
     * Must be a valid URL if provided.
     * @param bool|null $shortLink If true, returns a shortened payment link.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     *
     * @throws APIException
     */
    public function create(
        array|BillingAddress $billing,
        array $customer,
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        string|Currency|null $billingCurrency = null,
        ?string $discountCode = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $paymentLink = null,
        ?string $paymentMethodID = null,
        ?bool $redirectImmediately = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?RequestOptions $requestOptions = null,
    ): PaymentNewResponse;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @throws APIException
     */
    public function retrieve(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): Payment;

    /**
     * @api
     *
     * @param string $brandID filter by Brand id
     * @param string|\DateTimeInterface $createdAtGte Get events after this created time
     * @param string|\DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param 'succeeded'|'failed'|'cancelled'|'processing'|'requires_customer_action'|'requires_merchant_action'|'requires_payment_method'|'requires_confirmation'|'requires_capture'|'partially_captured'|'partially_captured_and_capturable'|Status $status Filter by status
     * @param string $subscriptionID Filter by subscription id
     *
     * @return DefaultPageNumberPagination<PaymentListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?string $brandID = null,
        string|\DateTimeInterface|null $createdAtGte = null,
        string|\DateTimeInterface|null $createdAtLte = null,
        ?string $customerID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        string|Status|null $status = null,
        ?string $subscriptionID = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $paymentID Payment Id
     *
     * @throws APIException
     */
    public function retrieveLineItems(
        string $paymentID,
        ?RequestOptions $requestOptions = null
    ): PaymentGetLineItemsResponse;
}
