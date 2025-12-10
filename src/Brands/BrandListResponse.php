<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Brands\Brand\VerificationStatus;
use Dodopayments\Core\Attributes\Required;
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
    #[Required(list: Brand::class)]
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
     *   brandID: string,
     *   businessID: string,
     *   enabled: bool,
     *   statementDescriptor: string,
     *   verificationEnabled: bool,
     *   verificationStatus: value-of<VerificationStatus>,
     *   description?: string|null,
     *   image?: string|null,
     *   name?: string|null,
     *   reasonForHold?: string|null,
     *   supportEmail?: string|null,
     *   url?: string|null,
     * }> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * List of brands for this business.
     *
     * @param list<Brand|array{
     *   brandID: string,
     *   businessID: string,
     *   enabled: bool,
     *   statementDescriptor: string,
     *   verificationEnabled: bool,
     *   verificationStatus: value-of<VerificationStatus>,
     *   description?: string|null,
     *   image?: string|null,
     *   name?: string|null,
     *   reasonForHold?: string|null,
     *   supportEmail?: string|null,
     *   url?: string|null,
     * }> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
