<?php

declare(strict_types=1);

namespace Dodopayments\Services;

use Dodopayments\Client;
use Dodopayments\Core\Exceptions\APIException;
use Dodopayments\Core\Util;
use Dodopayments\DefaultPageNumberPagination;
use Dodopayments\ProductCollections\Groups\ProductCollectionGroupDetails;
use Dodopayments\ProductCollections\ProductCollection;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\EffectiveAtOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\EffectiveAtOnUpgrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\OnPaymentFailure;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\ProrationBillingModeOnDowngrade;
use Dodopayments\ProductCollections\ProductCollectionCreateParams\ProrationBillingModeOnUpgrade;
use Dodopayments\ProductCollections\ProductCollectionListResponse;
use Dodopayments\ProductCollections\ProductCollectionUnarchiveResponse;
use Dodopayments\ProductCollections\ProductCollectionUpdateImagesResponse;
use Dodopayments\RequestOptions;
use Dodopayments\ServiceContracts\ProductCollectionsContract;
use Dodopayments\Services\ProductCollections\GroupsService;

/**
 * @phpstan-import-type ProductCollectionGroupDetailsShape from \Dodopayments\ProductCollections\Groups\ProductCollectionGroupDetails
 * @phpstan-import-type RequestOpts from \Dodopayments\RequestOptions
 */
final class ProductCollectionsService implements ProductCollectionsContract
{
    /**
     * @api
     */
    public ProductCollectionsRawService $raw;

    /**
     * @api
     */
    public GroupsService $groups;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProductCollectionsRawService($client);
        $this->groups = new GroupsService($client);
    }

    /**
     * @api
     *
     * @param list<ProductCollectionGroupDetails|ProductCollectionGroupDetailsShape> $groups Groups of products in this collection
     * @param string $name Name of the product collection
     * @param string|null $brandID Brand id for the collection, if not provided will default to primary brand
     * @param string|null $description Optional description of the product collection
     * @param EffectiveAtOnDowngrade|value-of<EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade Default effective_at setting for subscription plan downgrades (NULL = inherit from business)
     * @param EffectiveAtOnUpgrade|value-of<EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade Default effective_at setting for subscription plan upgrades (NULL = inherit from business)
     * @param OnPaymentFailure|value-of<OnPaymentFailure>|null $onPaymentFailure Default behavior for subscription plan changes on payment failure (NULL = inherit from business)
     * @param ProrationBillingModeOnDowngrade|value-of<ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade Default proration billing mode for subscription plan downgrades (NULL = inherit from business)
     * @param ProrationBillingModeOnUpgrade|value-of<ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade Default proration billing mode for subscription plan upgrades (NULL = inherit from business)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $groups,
        string $name,
        ?string $brandID = null,
        ?string $description = null,
        EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade = null,
        EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade = null,
        OnPaymentFailure|string|null $onPaymentFailure = null,
        ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade = null,
        ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProductCollection {
        $params = Util::removeNulls(
            [
                'groups' => $groups,
                'name' => $name,
                'brandID' => $brandID,
                'description' => $description,
                'effectiveAtOnDowngrade' => $effectiveAtOnDowngrade,
                'effectiveAtOnUpgrade' => $effectiveAtOnUpgrade,
                'onPaymentFailure' => $onPaymentFailure,
                'prorationBillingModeOnDowngrade' => $prorationBillingModeOnDowngrade,
                'prorationBillingModeOnUpgrade' => $prorationBillingModeOnUpgrade,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProductCollection {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param string|null $brandID Optional brand_id update
     * @param string|null $description Optional description update - pass null to remove, omit to keep unchanged
     * @param \Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnDowngrade|value-of<\Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnDowngrade>|null $effectiveAtOnDowngrade Effective_at setting for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change
     * @param \Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnUpgrade|value-of<\Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnUpgrade>|null $effectiveAtOnUpgrade Effective_at setting for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change
     * @param list<string>|null $groupOrder Optional new order for groups (array of group UUIDs in desired order)
     * @param string|null $imageID Optional image update - pass null to remove, omit to keep unchanged
     * @param string|null $name Optional new name for the collection
     * @param \Dodopayments\ProductCollections\ProductCollectionUpdateParams\OnPaymentFailure|value-of<\Dodopayments\ProductCollections\ProductCollectionUpdateParams\OnPaymentFailure>|null $onPaymentFailure On payment failure behavior: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change
     * @param \Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnDowngrade|value-of<\Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnDowngrade>|null $prorationBillingModeOnDowngrade Proration billing mode for downgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change
     * @param \Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnUpgrade|value-of<\Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnUpgrade>|null $prorationBillingModeOnUpgrade Proration billing mode for upgrades: Some(Some(val)) = set, Some(None) = clear (inherit), None = no change
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $brandID = null,
        ?string $description = null,
        \Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnDowngrade|string|null $effectiveAtOnDowngrade = null,
        \Dodopayments\ProductCollections\ProductCollectionUpdateParams\EffectiveAtOnUpgrade|string|null $effectiveAtOnUpgrade = null,
        ?array $groupOrder = null,
        ?string $imageID = null,
        ?string $name = null,
        \Dodopayments\ProductCollections\ProductCollectionUpdateParams\OnPaymentFailure|string|null $onPaymentFailure = null,
        \Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnDowngrade|string|null $prorationBillingModeOnDowngrade = null,
        \Dodopayments\ProductCollections\ProductCollectionUpdateParams\ProrationBillingModeOnUpgrade|string|null $prorationBillingModeOnUpgrade = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'brandID' => $brandID,
                'description' => $description,
                'effectiveAtOnDowngrade' => $effectiveAtOnDowngrade,
                'effectiveAtOnUpgrade' => $effectiveAtOnUpgrade,
                'groupOrder' => $groupOrder,
                'imageID' => $imageID,
                'name' => $name,
                'onPaymentFailure' => $onPaymentFailure,
                'prorationBillingModeOnDowngrade' => $prorationBillingModeOnDowngrade,
                'prorationBillingModeOnUpgrade' => $prorationBillingModeOnUpgrade,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param bool $archived List archived collections
     * @param string $brandID Filter by Brand id
     * @param int $pageNumber Page number default is 0
     * @param int $pageSize Page size default is 10 max is 100
     * @param RequestOpts|null $requestOptions
     *
     * @return DefaultPageNumberPagination<ProductCollectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?string $brandID = null,
        ?int $pageNumber = null,
        ?int $pageSize = null,
        RequestOptions|array|null $requestOptions = null,
    ): DefaultPageNumberPagination {
        $params = Util::removeNulls(
            [
                'archived' => $archived,
                'brandID' => $brandID,
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
     * @param string $id Product Collection Id
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
     * @param string $id Product Collection Id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unarchive(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): ProductCollectionUnarchiveResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unarchive($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @param string $id Product Collection Id
     * @param bool|null $forceUpdate If true, generates a new image ID to force cache invalidation
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function updateImages(
        string $id,
        ?bool $forceUpdate = null,
        RequestOptions|array|null $requestOptions = null,
    ): ProductCollectionUpdateImagesResponse {
        $params = Util::removeNulls(['forceUpdate' => $forceUpdate]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->updateImages($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
