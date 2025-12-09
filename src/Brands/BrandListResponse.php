<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Brands\Brand\VerificationStatus;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandListResponseShape = array{items: list<Brand>}
 */
final class BrandListResponse implements BaseModel
{
    /** @use SdkModel<BrandListResponseShape> */
    use SdkModel;

    /**
     * List of brands for this business.
     *
     * @var list<Brand> $items
     */
    #[Api(list: Brand::class)]
    public array $items;

    /**
     * `new BrandListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BrandListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BrandListResponse)->withItems(...)
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
     * @param list<Brand|array{
     *   brand_id: string,
     *   business_id: string,
     *   enabled: bool,
     *   statement_descriptor: string,
     *   verification_enabled: bool,
     *   verification_status: value-of<VerificationStatus>,
     *   description?: string|null,
     *   image?: string|null,
     *   name?: string|null,
     *   reason_for_hold?: string|null,
     *   support_email?: string|null,
     *   url?: string|null,
     * }> $items
     */
    public static function with(array $items): self
    {
        $obj = new self;

        $obj['items'] = $items;

        return $obj;
    }

    /**
     * List of brands for this business.
     *
     * @param list<Brand|array{
     *   brand_id: string,
     *   business_id: string,
     *   enabled: bool,
     *   statement_descriptor: string,
     *   verification_enabled: bool,
     *   verification_status: value-of<VerificationStatus>,
     *   description?: string|null,
     *   image?: string|null,
     *   name?: string|null,
     *   reason_for_hold?: string|null,
     *   support_email?: string|null,
     *   url?: string|null,
     * }> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }
}
