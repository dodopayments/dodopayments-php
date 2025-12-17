<?php

declare(strict_types=1);

namespace Dodopayments\Licenses;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Licenses\LicenseActivateResponse\Product;
use Dodopayments\Payments\CustomerLimitedDetails;

/**
 * @phpstan-import-type CustomerLimitedDetailsShape from \Dodopayments\Payments\CustomerLimitedDetails
 * @phpstan-import-type ProductShape from \Dodopayments\Licenses\LicenseActivateResponse\Product
 *
 * @phpstan-type LicenseActivateResponseShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customer: CustomerLimitedDetails|CustomerLimitedDetailsShape,
 *   licenseKeyID: string,
 *   name: string,
 *   product: Product|ProductShape,
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
     * @param CustomerLimitedDetailsShape $customer
     * @param ProductShape $product
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
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['customer'] = $customer;
        $self['licenseKeyID'] = $licenseKeyID;
        $self['name'] = $name;
        $self['product'] = $product;

        return $self;
    }

    /**
     * License key instance ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Business ID.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Limited customer details associated with the license key.
     *
     * @param CustomerLimitedDetailsShape $customer
     */
    public function withCustomer(CustomerLimitedDetails|array $customer): self
    {
        $self = clone $this;
        $self['customer'] = $customer;

        return $self;
    }

    /**
     * Associated license key ID.
     */
    public function withLicenseKeyID(string $licenseKeyID): self
    {
        $self = clone $this;
        $self['licenseKeyID'] = $licenseKeyID;

        return $self;
    }

    /**
     * Instance name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Related product info. Present if the license key is tied to a product.
     *
     * @param ProductShape $product
     */
    public function withProduct(Product|array $product): self
    {
        $self = clone $this;
        $self['product'] = $product;

        return $self;
    }
}
