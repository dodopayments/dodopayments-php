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
 *   business_id: string,
 *   created_at: \DateTimeInterface,
 *   customer: CustomerLimitedDetails,
 *   license_key_id: string,
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
    #[Api]
    public string $business_id;

    /**
     * Creation timestamp.
     */
    #[Api]
    public \DateTimeInterface $created_at;

    /**
     * Limited customer details associated with the license key.
     */
    #[Api]
    public CustomerLimitedDetails $customer;

    /**
     * Associated license key ID.
     */
    #[Api]
    public string $license_key_id;

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
     *   business_id: ...,
     *   created_at: ...,
     *   customer: ...,
     *   license_key_id: ...,
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
     *
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     * @param Product|array{product_id: string, name?: string|null} $product
     */
    public static function with(
        string $id,
        string $business_id,
        \DateTimeInterface $created_at,
        CustomerLimitedDetails|array $customer,
        string $license_key_id,
        string $name,
        Product|array $product,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['business_id'] = $business_id;
        $obj['created_at'] = $created_at;
        $obj['customer'] = $customer;
        $obj['license_key_id'] = $license_key_id;
        $obj['name'] = $name;
        $obj['product'] = $product;

        return $obj;
    }

    /**
     * License key instance ID.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * Business ID.
     */
    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * Limited customer details associated with the license key.
     *
     * @param CustomerLimitedDetails|array{
     *   customer_id: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phone_number?: string|null,
     * } $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $obj = clone $this;
        $obj['customer'] = $customer;

        return $obj;
    }

    /**
     * Associated license key ID.
     */
    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $obj = clone $this;
        $obj['license_key_id'] = $licenseKeyID;

        return $obj;
    }

    /**
     * Instance name.
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Related product info. Present if the license key is tied to a product.
     *
     * @param Product|array{product_id: string, name?: string|null} $product
     */
    public function withProduct(Product|array $product): self
    {
        $obj = clone $this;
        $obj['product'] = $product;

        return $obj;
    }
}
