<?php

declare(strict_types=1);

namespace Dodopayments\Brands;

use Dodopayments\Brands\Brand\VerificationStatus;
use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type BrandShape = array{
 *   brandID: string,
 *   businessID: string,
 *   enabled: bool,
 *   statementDescriptor: string,
 *   verificationEnabled: bool,
 *   verificationStatus: VerificationStatus|value-of<VerificationStatus>,
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
    /** @use SdkModel<BrandShape> */
    use SdkModel;

    #[Required('brand_id')]
    public string $brandID;

    #[Required('business_id')]
    public string $businessID;

    #[Required]
    public bool $enabled;

    #[Required('statement_descriptor')]
    public string $statementDescriptor;

    #[Required('verification_enabled')]
    public bool $verificationEnabled;

    /** @var value-of<VerificationStatus> $verificationStatus */
    #[Required('verification_status', enum: VerificationStatus::class)]
    public string $verificationStatus;

    #[Optional(nullable: true)]
    public ?string $description;

    #[Optional(nullable: true)]
    public ?string $image;

    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * Incase the brand verification fails or is put on hold.
     */
    #[Optional('reason_for_hold', nullable: true)]
    public ?string $reasonForHold;

    #[Optional('support_email', nullable: true)]
    public ?string $supportEmail;

    #[Optional(nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public static function with(
        string $brandID,
        string $businessID,
        bool $enabled,
        string $statementDescriptor,
        bool $verificationEnabled,
        VerificationStatus|string $verificationStatus,
        ?string $description = null,
        ?string $image = null,
        ?string $name = null,
        ?string $reasonForHold = null,
        ?string $supportEmail = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['brandID'] = $brandID;
        $self['businessID'] = $businessID;
        $self['enabled'] = $enabled;
        $self['statementDescriptor'] = $statementDescriptor;
        $self['verificationEnabled'] = $verificationEnabled;
        $self['verificationStatus'] = $verificationStatus;

        null !== $description && $self['description'] = $description;
        null !== $image && $self['image'] = $image;
        null !== $name && $self['name'] = $name;
        null !== $reasonForHold && $self['reasonForHold'] = $reasonForHold;
        null !== $supportEmail && $self['supportEmail'] = $supportEmail;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withBrandID(string $brandID): self
    {
        $self = clone $this;
        $self['brandID'] = $brandID;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    public function withStatementDescriptor(string $statementDescriptor): self
    {
        $self = clone $this;
        $self['statementDescriptor'] = $statementDescriptor;

        return $self;
    }

    public function withVerificationEnabled(bool $verificationEnabled): self
    {
        $self = clone $this;
        $self['verificationEnabled'] = $verificationEnabled;

        return $self;
    }

    /**
     * @param VerificationStatus|value-of<VerificationStatus> $verificationStatus
     */
    public function withVerificationStatus(
        VerificationStatus|string $verificationStatus
    ): self {
        $self = clone $this;
        $self['verificationStatus'] = $verificationStatus;

        return $self;
    }

    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withImage(?string $image): self
    {
        $self = clone $this;
        $self['image'] = $image;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Incase the brand verification fails or is put on hold.
     */
    public function withReasonForHold(?string $reasonForHold): self
    {
        $self = clone $this;
        $self['reasonForHold'] = $reasonForHold;

        return $self;
    }

    public function withSupportEmail(?string $supportEmail): self
    {
        $self = clone $this;
        $self['supportEmail'] = $supportEmail;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
