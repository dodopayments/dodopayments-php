<?php

declare(strict_types=1);

namespace Dodopayments\Services\Products;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\Misc\CountryCode;
use Dodopayments\Misc\Currency;
use Dodopayments\Products\LocalizedPrices\ListLocalizedPricesResponse;
use Dodopayments\Products\LocalizedPrices\LocalizedPrice;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\Products\LocalizedPricesContract;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class LocalizedPricesService implements LocalizedPricesContract
{
    /**
     * @api
     */
    public LocalizedPricesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LocalizedPricesRawService($client);
    }

    /**
     * @api
     *
     * @param string $productID Product Id
     * @param int $amount Amount in the smallest currency unit (e.g., cents). Must be greater than zero.
     * @param Currency|value-of<Currency> $currency Currency to charge in. Must be a supported currency.
     * @param CountryCode|value-of<CountryCode>|null $countryCode required when the product's pricing_mode is by_country; forbidden when by_currency
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $productID,
        int $amount,
        Currency|string $currency,
        CountryCode|string|null $countryCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): LocalizedPrice {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'currency' => $currency,
                'countryCode' => $countryCode,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($productID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param string $productID Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        string $productID,
        RequestOptions|array|null $requestOptions = null,
    ): LocalizedPrice {
        $params = Util::removeNulls(['productID' => $productID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Path param: Localized Price Id
     * @param string $productID Path param: Product Id
     * @param int|null $amount Body param: New amount in the smallest currency unit (e.g., cents). Must be greater
     * than zero. The currency and country_code of an existing rule cannot be changed.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        string $productID,
        ?int $amount = null,
        RequestOptions|array|null $requestOptions = null,
    ): LocalizedPrice {
        $params = Util::removeNulls(
            ['productID' => $productID, 'amount' => $amount]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $productID Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $productID,
        RequestOptions|array|null $requestOptions = null
    ): ListLocalizedPricesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($productID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Localized Price Id
     * @param string $productID Product Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $id,
        string $productID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['productID' => $productID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
