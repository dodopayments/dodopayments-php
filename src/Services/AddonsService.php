<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Addons\AddonResponse;
use Dodopayments\Addons\AddonUpdateImagesResponse;
use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\Misc\Currency;
use Dodopayments\Misc\TaxCategory;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\AddonsContract;
use Dodopayments\Services\Addons\TranslationsService;

/**
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class AddonsService implements AddonsContract
{
    /**
     * @api
     */
    public AddonsRawService $raw;

    /**
     * @api
     */
    public TranslationsService $translations;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AddonsRawService($client);
        $this->translations = new TranslationsService($client);
    }

    /**
     * @api
     *
     * @param Currency|value-of<Currency> $currency The currency of the Addon
     * @param string $name Name of the Addon
     * @param int $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory> $taxCategory Tax category applied to this Addon
     * @param string|null $description Optional description of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Currency|string $currency,
        string $name,
        int $price,
        TaxCategory|string $taxCategory,
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
                'description' => $description,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?string $locale = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse {
        $params = Util::removeNulls(['locale' => $locale]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param Currency|value-of<Currency>|null $currency The currency of the Addon
     * @param string|null $description description of the Addon, optional and must be at most 1000 characters
     * @param string|null $imageID Addon image id after its uploaded to S3.
     * Pass `null` to remove the existing image, omit to keep it unchanged.
     * @param string|null $name name of the Addon, optional and must be at most 100 characters
     * @param int|null $price Amount of the addon
     * @param TaxCategory|value-of<TaxCategory>|null $taxCategory tax category of the Addon
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        Currency|string|null $currency = null,
        ?string $description = null,
        ?string $imageID = null,
        ?string $name = null,
        ?int $price = null,
        TaxCategory|string|null $taxCategory = null,
        RequestOptions|array|null $requestOptions = null,
    ): AddonResponse {
        $params = Util::removeNulls(
            [
                'currency' => $currency,
                'description' => $description,
                'imageID' => $imageID,
                'name' => $name,
                'price' => $price,
                'taxCategory' => $taxCategory,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param bool $archived List archived addons. The default is false.
     * @param string $locale Shows the translated name, description and unit of the catalog entities in this
     * locale. The value must be a code from `GET /locales`, for example `fr`.
     * A field with no translation, an unknown code, or no code shows the base text.
     *
     * Do not send a text from a localized response back in a create or update request.
     * The base text then changes to the translated text.
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<AddonResponse>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?string $locale = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'archived' => $archived,
                'locale' => $locale,
                'pageNumber' => $pageNumber,
                'pageSize' => $pageSize,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unarchive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Addon Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): AddonUpdateImagesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateImages($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
