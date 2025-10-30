<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkResponse;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\Contracts\ResponseConverter;
use Dodopayments\Licenses\LicenseActivateResponse\Product;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-type LicenseActivateResponseShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customer: CustomerLimitedDetails,
 *   licenseKeyID: string,
 *   name: string,
 *   product: Product,
 * }
 */
final class LicenseActivateResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<LicenseActivateResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * License key instance ID.
     */
    #[Api]
    public string $id;

    /**
     * Business ID.
     */
    #[Api('business_id')]
    public string $businessID;

    /**
     * Creation timestamp.
     */
    #[Api('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Limited customer details associated with the license key.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Associated license key ID.
     */
    #[Api('license_key_id')]
    public string $licenseKeyID;

    /**
     * Instance name.
     */
    #[Api]
    public string $name;

    /**
     * Related product info. Present if the license key is tied to a product.
     */
    #[Api]
    public Product $product;

    /**
     * `new LicenseActivateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseActivateResponse::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   customer: ...,
     *   licenseKeyID: ...,
     *   name: ...,
     *   product: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseActivateResponse)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomer(...)
     *   ->withLicenseKeyID(...)
     *   ->withName(...)
     *   ->withProduct(...)
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
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        CustomerLimitedDetails $customer,
        string $licenseKeyID,
        string $name,
        Product $product,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->businessID = $businessID;
        $obj->createdAt = $createdAt;
        $obj->customer = $customer;
        $obj->licenseKeyID = $licenseKeyID;
        $obj->name = $name;
        $obj->product = $product;

        return $obj;
    }

    /**
     * License key instance ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Business ID.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj->createdAt = $createdAt;

        return $obj;
    }

    /**
     * Limited customer details associated with the license key.
     */
    public function withCustomer(CustomerLimitedDetails $customer): self
    {
        $obj = clone $this;
        $obj->customer = $customer;

        return $obj;
    }

    /**
     * Associated license key ID.
     */
    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj->licenseKeyID = $licenseKeyID;

        return $obj;
    }

    /**
     * Instance name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Related product info. Present if the license key is tied to a product.
     */
    public function withProduct(Product $product): self
    {
        $obj = clone $this;
        $obj->product = $product;

        return $obj;
    }
}
