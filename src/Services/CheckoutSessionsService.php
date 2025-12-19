<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\CheckoutSessions\CheckoutSessionCreateParams\Customization\Theme;
use Dodopayments\CheckoutSessions\CheckoutSessionResponse;
use Dodopayments\CheckoutSessions\CheckoutSessionStatus;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Payments\PaymentMethodTypes;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\CheckoutSessionsContract;

final class CheckoutSessionsService implements CheckoutSessionsContract
{
    /**
     * @api
     */
    public CheckoutSessionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckoutSessionsRawService($client);
    }

    /**
     * @api
     *
     * @param list<array{
     *   productID: string,
     *   quantity: int,
     *   addons?: list<array{addonID: string, quantity: int}>|null,
     *   amount?: int|null,
     * }> $productCart
     * @param list<'credit'|'debit'|'upi_collect'|'upi_intent'|'apple_pay'|'cashapp'|'google_pay'|'multibanco'|'bancontact_card'|'eps'|'ideal'|'przelewy24'|'paypal'|'affirm'|'klarna'|'sepa'|'ach'|'amazon_pay'|'afterpay_clearpay'|PaymentMethodTypes>|null $allowedPaymentMethodTypes Customers will never see payment methods that are not in this list.
     * However, adding a method here does not guarantee customers will see it.
     * Availability still depends on other factors (e.g., customer location, merchant settings).
     *
     * Disclaimar: Always provide 'credit' and 'debit' as a fallback.
     * If all payment methods are unavailable, checkout session will fail.
     * @param array{
     *   country: 'AF'|'AX'|'AL'|'DZ'|'AS'|'AD'|'AO'|'AI'|'AQ'|'AG'|'AR'|'AM'|'AW'|'AU'|'AT'|'AZ'|'BS'|'BH'|'BD'|'BB'|'BY'|'BE'|'BZ'|'BJ'|'BM'|'BT'|'BO'|'BQ'|'BA'|'BW'|'BV'|'BR'|'IO'|'BN'|'BG'|'BF'|'BI'|'KH'|'CM'|'CA'|'CV'|'KY'|'CF'|'TD'|'CL'|'CN'|'CX'|'CC'|'CO'|'KM'|'CG'|'CD'|'CK'|'CR'|'CI'|'HR'|'CU'|'CW'|'CY'|'CZ'|'DK'|'DJ'|'DM'|'DO'|'EC'|'EG'|'SV'|'GQ'|'ER'|'EE'|'ET'|'FK'|'FO'|'FJ'|'FI'|'FR'|'GF'|'PF'|'TF'|'GA'|'GM'|'GE'|'DE'|'GH'|'GI'|'GR'|'GL'|'GD'|'GP'|'GU'|'GT'|'GG'|'GN'|'GW'|'GY'|'HT'|'HM'|'VA'|'HN'|'HK'|'HU'|'IS'|'IN'|'ID'|'IR'|'IQ'|'IE'|'IM'|'IL'|'IT'|'JM'|'JP'|'JE'|'JO'|'KZ'|'KE'|'KI'|'KP'|'KR'|'KW'|'KG'|'LA'|'LV'|'LB'|'LS'|'LR'|'LY'|'LI'|'LT'|'LU'|'MO'|'MK'|'MG'|'MW'|'MY'|'MV'|'ML'|'MT'|'MH'|'MQ'|'MR'|'MU'|'YT'|'MX'|'FM'|'MD'|'MC'|'MN'|'ME'|'MS'|'MA'|'MZ'|'MM'|'NA'|'NR'|'NP'|'NL'|'NC'|'NZ'|'NI'|'NE'|'NG'|'NU'|'NF'|'MP'|'NO'|'OM'|'PK'|'PW'|'PS'|'PA'|'PG'|'PY'|'PE'|'PH'|'PN'|'PL'|'PT'|'PR'|'QA'|'RE'|'RO'|'RU'|'RW'|'BL'|'SH'|'KN'|'LC'|'MF'|'PM'|'VC'|'WS'|'SM'|'ST'|'SA'|'SN'|'RS'|'SC'|'SL'|'SG'|'SX'|'SK'|'SI'|'SB'|'SO'|'ZA'|'GS'|'SS'|'ES'|'LK'|'SD'|'SR'|'SJ'|'SZ'|'SE'|'CH'|'SY'|'TW'|'TJ'|'TZ'|'TH'|'TL'|'TG'|'TK'|'TO'|'TT'|'TN'|'TR'|'TM'|'TC'|'TV'|'UG'|'UA'|'AE'|'GB'|'UM'|'US'|'UY'|'UZ'|'VU'|'VE'|'VN'|'VG'|'VI'|'WF'|'EH'|'YE'|'ZM'|'ZW'|CountryCode,
     *   city?: string|null,
     *   state?: string|null,
     *   street?: string|null,
     *   zipcode?: string|null,
     * }|null $billingAddress Billing address information for the session
     * @param 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null $billingCurrency This field is ingored if adaptive pricing is disabled
     * @param bool $confirm If confirm is true, all the details will be finalized. If required data is missing, an API error is thrown.
     * @param array<string,mixed>|null $customer Customer details for the session
     * @param array{
     *   forceLanguage?: string|null,
     *   showOnDemandTag?: bool,
     *   showOrderDetails?: bool,
     *   theme?: 'dark'|'light'|'system'|Theme,
     * } $customization Customization for the checkout session page
     * @param array{
     *   allowCurrencySelection?: bool,
     *   allowCustomerEditingCity?: bool,
     *   allowCustomerEditingCountry?: bool,
     *   allowCustomerEditingEmail?: bool,
     *   allowCustomerEditingName?: bool,
     *   allowCustomerEditingState?: bool,
     *   allowCustomerEditingStreet?: bool,
     *   allowCustomerEditingZipcode?: bool,
     *   allowDiscountCode?: bool,
     *   allowPhoneNumberCollection?: bool,
     *   allowTaxID?: bool,
     *   alwaysCreateNewCustomer?: bool,
     *   redirectImmediately?: bool,
     * } $featureFlags
     * @param bool|null $force3DS Override merchant default 3DS behaviour for this session
     * @param array<string,string>|null $metadata Additional metadata associated with the payment. Defaults to empty if not provided.
     * @param bool $minimalAddress If true, only zipcode is required when confirm is true; other address fields remain optional
     * @param string|null $returnURL the url to redirect after payment failure or success
     * @param bool $shortLink If true, returns a shortened checkout URL.
     * Defaults to false if not specified.
     * @param bool $showSavedPaymentMethods Display saved payment methods of a returning customer False by default
     * @param array{
     *   onDemand?: array{
     *     mandateOnly: bool,
     *     adaptiveCurrencyFeesInclusive?: bool|null,
     *     productCurrency?: 'AED'|'ALL'|'AMD'|'ANG'|'AOA'|'ARS'|'AUD'|'AWG'|'AZN'|'BAM'|'BBD'|'BDT'|'BGN'|'BHD'|'BIF'|'BMD'|'BND'|'BOB'|'BRL'|'BSD'|'BWP'|'BYN'|'BZD'|'CAD'|'CHF'|'CLP'|'CNY'|'COP'|'CRC'|'CUP'|'CVE'|'CZK'|'DJF'|'DKK'|'DOP'|'DZD'|'EGP'|'ETB'|'EUR'|'FJD'|'FKP'|'GBP'|'GEL'|'GHS'|'GIP'|'GMD'|'GNF'|'GTQ'|'GYD'|'HKD'|'HNL'|'HRK'|'HTG'|'HUF'|'IDR'|'ILS'|'INR'|'IQD'|'JMD'|'JOD'|'JPY'|'KES'|'KGS'|'KHR'|'KMF'|'KRW'|'KWD'|'KYD'|'KZT'|'LAK'|'LBP'|'LKR'|'LRD'|'LSL'|'LYD'|'MAD'|'MDL'|'MGA'|'MKD'|'MMK'|'MNT'|'MOP'|'MRU'|'MUR'|'MVR'|'MWK'|'MXN'|'MYR'|'MZN'|'NAD'|'NGN'|'NIO'|'NOK'|'NPR'|'NZD'|'OMR'|'PAB'|'PEN'|'PGK'|'PHP'|'PKR'|'PLN'|'PYG'|'QAR'|'RON'|'RSD'|'RUB'|'RWF'|'SAR'|'SBD'|'SCR'|'SEK'|'SGD'|'SHP'|'SLE'|'SLL'|'SOS'|'SRD'|'SSP'|'STN'|'SVC'|'SZL'|'THB'|'TND'|'TOP'|'TRY'|'TTD'|'TWD'|'TZS'|'UAH'|'UGX'|'USD'|'UYU'|'UZS'|'VES'|'VND'|'VUV'|'WST'|'XAF'|'XCD'|'XOF'|'XPF'|'YER'|'ZAR'|'ZMW'|Currency|null,
     *     productDescription?: string|null,
     *     productPrice?: int|null,
     *   }|null,
     *   trialPeriodDays?: int|null,
     * }|null $subscriptionData
     *
     * @throws APIException
     */
    public function create(
        array $productCart,
        ?array $allowedPaymentMethodTypes = null,
        ?array $billingAddress = null,
        string|Currency|null $billingCurrency = null,
        ?bool $confirm = null,
        ?array $customer = null,
        ?array $customization = null,
        ?string $discountCode = null,
        ?array $featureFlags = null,
        ?bool $force3DS = null,
        ?array $metadata = null,
        ?bool $minimalAddress = null,
        ?string $returnURL = null,
        ?bool $shortLink = null,
        ?bool $showSavedPaymentMethods = null,
        ?array $subscriptionData = null,
        ?RequestOptions $requestOptions = null,
    ): CheckoutSessionResponse {
        $params = Util::removeNulls(
            [
                'productCart' => $productCart,
                'allowedPaymentMethodTypes' => $allowedPaymentMethodTypes,
                'billingAddress' => $billingAddress,
                'billingCurrency' => $billingCurrency,
                'confirm' => $confirm,
                'customer' => $customer,
                'customization' => $customization,
                'discountCode' => $discountCode,
                'featureFlags' => $featureFlags,
                'force3DS' => $force3DS,
                'metadata' => $metadata,
                'minimalAddress' => $minimalAddress,
                'returnURL' => $returnURL,
                'shortLink' => $shortLink,
                'showSavedPaymentMethods' => $showSavedPaymentMethods,
                'subscriptionData' => $subscriptionData,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
