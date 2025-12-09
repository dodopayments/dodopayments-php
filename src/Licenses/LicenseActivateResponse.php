<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
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
final class LicenseActivateResponse implements BaseModel
{
    /** @use SdkModel<LicenseActivateResponseShape> */
    use SdkModel;

    /**
     * License key instance ID.
     */
    #[Required]
    public string $id;

    /**
     * Business ID.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Creation timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Limited customer details associated with the license key.
     */
    #[Required]
    public CustomerLimitedDetails $customer;

    /**
     * Associated license key ID.
     */
    #[Required('license_key_id')]
    public string $licenseKeyID;

    /**
     * Instance name.
     */
    #[Required]
    public string $name;

    /**
     * Related product info. Present if the license key is tied to a product.
     */
    #[Required]
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
     *
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
     * } $customer
     * @param Product|array{productID: string, name?: string|null} $product
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        CustomerLimitedDetails|array $customer,
        string $licenseKeyID,
        string $name,
        Product|array $product,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['businessID'] = $businessID;
        $obj['createdAt'] = $createdAt;
        $obj['customer'] = $customer;
        $obj['licenseKeyID'] = $licenseKeyID;
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
        $obj['businessID'] = $businessID;

        return $obj;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * Limited customer details associated with the license key.
     *
     * @param CustomerLimitedDetails|array{
     *   customerID: string,
     *   email: string,
     *   name: string,
     *   metadata?: array<string,string>|null,
     *   phoneNumber?: string|null,
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
        $obj['licenseKeyID'] = $licenseKeyID;

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
     * @param Product|array{productID: string, name?: string|null} $product
     */
    public function withProduct(Product|array $product): self
    {
        $obj = clone $this;
        $obj['product'] = $product;

        return $obj;
    }
}
