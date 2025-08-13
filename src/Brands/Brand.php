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
    public static function from(
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

    public function setBrandID(string $brandID): self
    {
        $this->brandID = $brandID;

        return $this;
    }

    public function setBusinessID(string $businessID): self
    {
        $this->businessID = $businessID;

        return $this;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function setStatementDescriptor(string $statementDescriptor): self
    {
        $this->statementDescriptor = $statementDescriptor;

        return $this;
    }

    public function setVerificationEnabled(bool $verificationEnabled): self
    {
        $this->verificationEnabled = $verificationEnabled;

        return $this;
    }

    /**
     * @param VerificationStatus::* $verificationStatus
     */
    public function setVerificationStatus(string $verificationStatus): self
    {
        $this->verificationStatus = $verificationStatus;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Incase the brand verification fails or is put on hold.
     */
    public function setReasonForHold(?string $reasonForHold): self
    {
        $this->reasonForHold = $reasonForHold;

        return $this;
    }

    public function setSupportEmail(?string $supportEmail): self
    {
        $this->supportEmail = $supportEmail;

        return $this;
    }

    public function setURL(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
