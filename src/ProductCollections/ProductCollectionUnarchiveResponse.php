<?php

declare(strict_types=1);

namespace Dodopayments\ProductCollections;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProductCollectionUnarchiveResponseShape = array{
 *   collectionID: string, excludedProductIDs: list<string>, message: string
 * }
 */
final class ProductCollectionUnarchiveResponse implements BaseModel
{
    /** @use SdkModel<ProductCollectionUnarchiveResponseShape> */
    use SdkModel;

    /**
     * Collection ID that was unarchived.
     */
    #[Required('collection_id')]
    public string $collectionID;

    /**
     * Product IDs that were excluded because they are archived.
     *
     * @var list<string> $excludedProductIDs
     */
    #[Required('excluded_product_ids', list: 'string')]
    public array $excludedProductIDs;

    /**
     * Success message.
     */
    #[Required]
    public string $message;

    /**
     * `new ProductCollectionUnarchiveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProductCollectionUnarchiveResponse::with(
     *   collectionID: ..., excludedProductIDs: ..., message: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProductCollectionUnarchiveResponse)
     *   ->withCollectionID(...)
     *   ->withExcludedProductIDs(...)
     *   ->withMessage(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $excludedProductIDs
     */
    public static function with(
        string $collectionID,
        array $excludedProductIDs,
        string $message
    ): self {
        $self = new self;

        $self['collectionID'] = $collectionID;
        $self['excludedProductIDs'] = $excludedProductIDs;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Collection ID that was unarchived.
     */
    public function withCollectionID(string $collectionID): self
    {
        $self = clone $this;
        $self['collectionID'] = $collectionID;

        return $self;
    }

    /**
     * Product IDs that were excluded because they are archived.
     *
     * @param list<string> $excludedProductIDs
     */
    public function withExcludedProductIDs(array $excludedProductIDs): self
    {
        $self = clone $this;
        $self['excludedProductIDs'] = $excludedProductIDs;

        return $self;
    }

    /**
     * Success message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }
}
