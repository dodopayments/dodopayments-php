<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Brands\Brand\VerificationStatus;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandShape = array{
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
 * }
 */
final class Brand implements BaseModel
{
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    #[Api]
    public string $brand_id;

    #[Api]
    public string $business_id;

    #[Api]
    public bool $enabled;

    #[Api]
    public string $statement_descriptor;

    #[Api]
    public bool $verification_enabled;

    /** @var value-of<VerificationStatus> $verification_status */
    #[Api(enum: VerificationStatus::class)]
    public string $verification_status;

    #[Api(nullable: true, optional: true)]
    public ?string $description;

    #[Api(nullable: true, optional: true)]
    public ?string $image;

    #[Api(nullable: true, optional: true)]
    public ?string $name;

    /**
     * Incase the brand verification fails or is put on hold.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $reason_for_hold;

    #[Api(nullable: true, optional: true)]
    public ?string $support_email;

    #[Api(nullable: true, optional: true)]
    public ?string $url;

    /**
     * `new Brand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Brand::with(
     *   brand_id: ...,
     *   business_id: ...,
     *   enabled: ...,
     *   statement_descriptor: ...,
     *   verification_enabled: ...,
     *   verification_status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Brand)
     *   ->withBrandID(...)
     *   ->withBusinessID(...)
     *   ->withEnabled(...)
     *   ->withStatementDescriptor(...)
     *   ->withVerificationEnabled(...)
     *   ->withVerificationStatus(...)
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
     * @param VerificationStatus|value-of<VerificationStatus> $verification_status
     */
    public static function with(
        string $brand_id,
        string $business_id,
        bool $enabled,
        string $statement_descriptor,
        bool $verification_enabled,
        VerificationStatus|string $verification_status,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?string $reason_for_hold = null,
        ?string $support_email = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        $obj['brand_id'] = $brand_id;
        $obj['business_id'] = $business_id;
        $obj['enabled'] = $enabled;
        $obj['statement_descriptor'] = $statement_descriptor;
        $obj['verification_enabled'] = $verification_enabled;
        $obj['verification_status'] = $verification_status;

        null !== $description && $obj['description'] = $description;
        null !== $image && $obj['image'] = $image;
        null !== $name && $obj['name'] = $name;
        null !== $reason_for_hold && $obj['reason_for_hold'] = $reason_for_hold;
        null !== $support_email && $obj['support_email'] = $support_email;
        null !== $url && $obj['url'] = $url;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj['brand_id'] = $brandID;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj['business_id'] = $businessID;

        return $obj;
    }

    public function withEnabled(bool $enabled): self
    {
        $obj = clone $this;
        $obj['enabled'] = $enabled;

        return $obj;
    }

    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $obj = clone $this;
        $obj['statement_descriptor'] = $statementDescriptor;

        return $obj;
    }

    public function withVerificationEnabled(bool $verificationEnabled): self
    {
        $obj = clone $this;
        $obj['verification_enabled'] = $verificationEnabled;

        return $obj;
    }

    /**
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public function withVerificationStatus(
        VerificationStatus|string $verificationStatus
    ): self {
        $obj = clone $this;
        $obj['verification_status'] = $verificationStatus;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj['description'] = $description;

        return $obj;
    }

    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj['image'] = $image;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    /**
     * Incase the brand verification fails or is put on hold.
     */
    public function withReasonForHold(?string $reasonForHold): self
    {
        $obj = clone $this;
        $obj['reason_for_hold'] = $reasonForHold;

        return $obj;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $obj = clone $this;
        $obj['support_email'] = $supportEmail;

        return $obj;
    }

    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }
}
