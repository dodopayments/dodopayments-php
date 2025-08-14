<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Brands\Brand\VerificationStatus;
use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type brand_alias = array{
 *   brandID: string,
 *   businessID: string,
 *   enabled: bool,
 *   statementDescriptor: string,
 *   verificationEnabled: bool,
 *   verificationStatus: VerificationStatus::*,
 *   description?: string|null,
 *   image?: string|null,
 *   name?: string|null,
 *   reasonForHold?: string|null,
 *   supportEmail?: string|null,
 *   url?: string|null,
 * }
 */
final class Brand implements BaseModel
{
    use Model;

    #[Api('brand_id')]
    public string $brandID;

    #[Api('business_id')]
    public string $businessID;

    #[Api]
    public bool $enabled;

    #[Api('statement_descriptor')]
    public string $statementDescriptor;

    #[Api('verification_enabled')]
    public bool $verificationEnabled;

    /** @var VerificationStatus::* $verificationStatus */
    #[Api('verification_status', enum: VerificationStatus::class)]
    public string $verificationStatus;

    #[Api(optional: true)]
    public ?string $description;

    #[Api(optional: true)]
    public ?string $image;

    #[Api(optional: true)]
    public ?string $name;

    /**
     * Incase the brand verification fails or is put on hold.
     */
    #[Api('reason_for_hold', optional: true)]
    public ?string $reasonForHold;

    #[Api('support_email', optional: true)]
    public ?string $supportEmail;

    #[Api(optional: true)]
    public ?string $url;

    /**
     * `new Brand()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Brand::with(
     *   brandID: ...,
     *   businessID: ...,
     *   enabled: ...,
     *   statementDescriptor: ...,
     *   verificationEnabled: ...,
     *   verificationStatus: ...,
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param VerificationStatus::* $verificationStatus
     */
    public static function with(
        string $brandID,
        string $businessID,
        bool $enabled,
        string $statementDescriptor,
        bool $verificationEnabled,
        string $verificationStatus,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?string $reasonForHold = null,
        ?string $supportEmail = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        $obj->brandID = $brandID;
        $obj->businessID = $businessID;
        $obj->enabled = $enabled;
        $obj->statementDescriptor = $statementDescriptor;
        $obj->verificationEnabled = $verificationEnabled;
        $obj->verificationStatus = $verificationStatus;

        null !== $description && $obj->description = $description;
        null !== $image && $obj->image = $image;
        null !== $name && $obj->name = $name;
        null !== $reasonForHold && $obj->reasonForHold = $reasonForHold;
        null !== $supportEmail && $obj->supportEmail = $supportEmail;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    public function withBrandID(string $brandID): self
    {
        $obj = clone $this;
        $obj->brandID = $brandID;

        return $obj;
    }

    public function withBusinessID(string $businessID): self
    {
        $obj = clone $this;
        $obj->businessID = $businessID;

        return $obj;
    }

    public function withEnabled(bool $enabled): self
    {
        $obj = clone $this;
        $obj->enabled = $enabled;

        return $obj;
    }

    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $obj = clone $this;
        $obj->statementDescriptor = $statementDescriptor;

        return $obj;
    }

    public function withVerificationEnabled(bool $verificationEnabled): self
    {
        $obj = clone $this;
        $obj->verificationEnabled = $verificationEnabled;

        return $obj;
    }

    /**
     * @param VerificationStatus::* $verificationStatus
     */
    public function withVerificationStatus(string $verificationStatus): self
    {
        $obj = clone $this;
        $obj->verificationStatus = $verificationStatus;

        return $obj;
    }

    public function withDescription(?string $description): self
    {
        $obj = clone $this;
        $obj->description = $description;

        return $obj;
    }

    public function withImage(?string $image): self
    {
        $obj = clone $this;
        $obj->image = $image;

        return $obj;
    }

    public function withName(?string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * Incase the brand verification fails or is put on hold.
     */
    public function withReasonForHold(?string $reasonForHold): self
    {
        $obj = clone $this;
        $obj->reasonForHold = $reasonForHold;

        return $obj;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $obj = clone $this;
        $obj->supportEmail = $supportEmail;

        return $obj;
    }

    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
