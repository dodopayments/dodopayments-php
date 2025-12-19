<?php

declare(strict_types=1);

namespace Dodopayments\ServiceContracts;

use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\BillingAddress;
use Dodopayments\Payments\OneTimeProductCartItem;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\Subscriptions\Subscription;
use Dodopayments\Subscriptions\SubscriptionChangePlanParams\ProrationBillingMode;
use Dodopayments\Subscriptions\SubscriptionChargeResponse;
use Dodopayments\Subscriptions\SubscriptionGetUsageHistoryResponse;
use Dodopayments\Subscriptions\SubscriptionListParams\Status;
use Dodopayments\Subscriptions\SubscriptionListResponse;
use Dodopayments\Subscriptions\SubscriptionNewResponse;
use Dodopayments\Subscriptions\SubscriptionPreviewChangePlanResponse;
use Dodopayments\Subscriptions\SubscriptionStatus;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodParams\Type;
use Dodopayments\Subscriptions\SubscriptionUpdatePaymentMethodResponse;

interface SubscriptionsContract
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
     * }|BillingAddress $billing Billing address information for the subscription
     * @param array<string,mixed> $customer Customer details for the subscription
     * @param string $productID Unique identifier of the product to subscribe to
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<array{
     *   addonID: string, quantity: int
     * }>|null $addons Attach addons to this subscription
     * @param list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null $allowedPaymentMethodTypes List of payment methods allowed during checkout.
     *
     * Customers will **never** see payment methods that are **not** in this list.
     * However, adding a method here **does not guarantee** customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     * @param 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null $billingCurrency Fix the currency in which the end customer is billed.
     * If Dodo Payments cannot support that currency for this transaction, it will not proceed
     * @param string|null $discountCode Discount Code to apply to the subscription
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this subscription
     * @param array<string,string> $metadata Additional metadata for the subscription
     * Defaults to empty if not specified
     * @param array{
     *   mandateOnly: bool,
     *   adaptiveCurrencyFeesInclusive?: bool|null,
     *   productCurrency?: 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null,
     *   productDescription?: string|null,
     *   productPrice?: int|null,
     * }|null $onDemand
     * @param list<array{
     *   productID: string, quantity: int, amount?: int|null
     * }|OneTimeProductCartItem>|null $oneTimeProductCart List of one time products that will be bundled with the first payment for this subscription
     * @param bool|null $paymentLink If true, generates a payment link.
     * Defaults to false if not specified.
     * @param bool $redirectImmediately If true, redirects the customer immediately after payment completion
     * False by default
     * @param string|null $returnURL Optional URL to redirect after successful subscription creation
     * @param bool|null $shortLink If true, returns a shortened payment link.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer
     * False by default
     * @param string|null $taxID Tax ID in case the payment is B2B. If tax id validation fails the payment creation will fail
     * @param int|null $trialPeriodDays Optional trial period in days
     * If specified, this value overrides the trial period set in the product's price
     * Must be between 0 and 10000 days
     *
     * @throws APIException
     */
    public function create(
        array|BillingAddress $billing,
        array $customer,
        string $productID,
        int $quantity,
        ?array $addons = null,
        ?array $allowedPaymentMethodTypes = null,
        string|Currency|null $billingCurrency = null,
        ?string $discountCode = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?array $onDemand = null,
        ?array $oneTimeProductCart = null,
        ?bool $paymentLink = null,
        ?bool $redirectImmediately = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?string $taxID = null,
        ?int $trialPeriodDays = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionNewResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     *
     * @throws APIException
     */
    public function retrieve(
        string $subscriptionID,
        ?RequestOptions $requestOptions = null
    ): Subscription;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param array{
     *   country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|BillingAddress|null $billing
     * @param bool|null $cancelAtNextBillingDate When set, the subscription will remain active until the end of billing period
     * @param array{nextBillingDate: string|\DateTimeInterface}|null $disableOnDemand
     * @param array<string,string>|null $metadata
     * @param 'pending'|'active'|'on_hold'|'cancelled'|'failed'|'expired'|SubscriptionStatus|null $status
     *
     * @throws APIException
     */
    public function update(
        string $subscriptionID,
        array|BillingAddress|null $billing = null,
        ?bool $cancelAtNextBillingDate = null,
        ?string $customerName = null,
        ?array $disableOnDemand = null,
        ?array $metadata = null,
        string|\DateTimeInterface|null $nextBillingDate = null,
        string|SubscriptionStatus|null $status = null,
        ?string $taxID = null,
        ?RequestOptions $requestOptions = null,
    ): Subscription;

    /**
     * @api
     *
     * @param string $brandID filter by Brand id
     * @param string|\DateTimeInterface $createdAtGte Get events after this created time
     * @param string|\DateTimeInterface $createdAtLte Get events created before this time
     * @param string $customerID Filter by customer id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param 'pending'|'active'|'on_hold'|'cancelled'|'failed'|'expired'|Status $status Filter by status
     *
     * @return DefaultPageNumberPagination<SubscriptionListResponse>
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
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param string $productID Unique identifier of the product to subscribe to
     * @param 'prorated_immediately'|'full_immediately'|'difference_immediately'|ProrationBillingMode $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<array{
     *   addonID: string, quantity: int
     * }>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     *
     * @throws APIException
     */
    public function changePlan(
        string $subscriptionID,
        string $productID,
        string|ProrationBillingMode $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param int $productPrice The product price. Represented in the lowest denomination of the currency (e.g., cents for USD).
     * For example, to charge $1.00, pass `100`.
     * @param bool|null $adaptiveCurrencyFeesInclusive Whether adaptive currency fees should be included in the product_price (true) or added on top (false).
     * This field is ignored if adaptive pricing is not enabled for the business.
     * @param array{
     *   allowCustomerCreditsPurchase?: bool|null,
     *   allowCustomerCreditsUsage?: bool|null,
     * }|null $customerBalanceConfig Specify how customer balance is used for the payment
     * @param array<string,string>|null $metadata Metadata for the payment. If not passed, the metadata of the subscription will be taken
     * @param 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null $productCurrency Optional currency of the product price. If not specified, defaults to the currency of the product.
     * @param string|null $productDescription Optional product description override for billing and line items.
     * If not specified, the stored description of the product will be used.
     *
     * @throws APIException
     */
    public function charge(
        string $subscriptionID,
        int $productPrice,
        ?bool $adaptiveCurrencyFeesInclusive = null,
        ?array $customerBalanceConfig = null,
        ?array $metadata = null,
        string|Currency|null $productCurrency = null,
        ?string $productDescription = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionChargeResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param string $productID Unique identifier of the product to subscribe to
     * @param 'prorated_immediately'|'full_immediately'|'difference_immediately'|\Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode $prorationBillingMode Proration Billing Mode
     * @param int $quantity Number of units to subscribe for. Must be at least 1.
     * @param list<array{
     *   addonID: string, quantity: int
     * }>|null $addons Addons for the new plan.
     * Note : Leaving this empty would remove any existing addons
     *
     * @throws APIException
     */
    public function previewChangePlan(
        string $subscriptionID,
        string $productID,
        string|\Dodopayments\Subscriptions\SubscriptionPreviewChangePlanParams\ProrationBillingMode $prorationBillingMode,
        int $quantity,
        ?array $addons = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionPreviewChangePlanResponse;

    /**
     * @api
     *
     * @param string $subscriptionID Unique subscription identifier
     * @param string|\DateTimeInterface|null $endDate Filter by end date (inclusive)
     * @param string|null $meterID Filter by specific meter ID
     * @param int|null $pageNumber Page number (default: 0)
     * @param int|null $pageSize Page size (default: 10, max: 100)
     * @param string|\DateTimeInterface|null $startDate Filter by start date (inclusive)
     *
     * @return DefaultPageNumberPagination<SubscriptionGetUsageHistoryResponse>
     *
     * @throws APIException
     */
    public function retrieveUsageHistory(
        string $subscriptionID,
        string|\DateTimeInterface|null $endDate = null,
        ?string $meterID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        string|\DateTimeInterface|null $startDate = null,
        ?RequestOptions $requestOptions = null,
    ): DefaultPageNumberPagination;

    /**
     * @api
     *
     * @param string $subscriptionID Subscription Id
     * @param 'existing'|Type $type
     *
     * @throws APIException
     */
    public function updatePaymentMethod(
        string $subscriptionID,
        string|Type $type,
        string $paymentMethodID,
        ?string $returnURL = null,
        ?RequestOptions $requestOptions = null,
    ): SubscriptionUpdatePaymentMethodResponse;
}
