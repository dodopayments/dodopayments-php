<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\WebhookEvents\WebhookPayload\Data\EntitlementGrant\PayloadType;
use Dodopayments\WebhookEvents\WebhookPayload\Data\EntitlementGrant\Status;

/**
 * @phpstan-type EntitlementGrantShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   entitlementID: string,
 *   externalID: string,
 *   payloadType: PayloadType|value-of<PayloadType>,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   deliveredAt?: \DateTimeInterface|null,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   licenseKey?: string|null,
 *   licenseKeyActivationsLimit?: int|null,
 *   licenseKeyActivationsUsed?: int|null,
 *   licenseKeyExpiresAt?: \DateTimeInterface|null,
 *   licenseKeyStatus?: string|null,
 *   metadata?: mixed,
 *   oauthExpiresAt?: \DateTimeInterface|null,
 *   oauthURL?: string|null,
 *   paymentID?: string|null,
 *   revocationReason?: string|null,
 *   revokedAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 * }
 */
final class EntitlementGrant implements BaseModel
{
    /** @use SdkModel<EntitlementGrantShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('business_id')]
    public string $businessID;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('entitlement_id')]
    public string $entitlementID;

    #[Required('external_id')]
    public string $externalID;

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('delivered_at', nullable: true)]
    public ?\DateTimeInterface $deliveredAt;

    #[Optional('error_code', nullable: true)]
    public ?string $errorCode;

    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    #[Optional('license_key', nullable: true)]
    public ?string $licenseKey;

    #[Optional('license_key_activations_limit', nullable: true)]
    public ?int $licenseKeyActivationsLimit;

    #[Optional('license_key_activations_used', nullable: true)]
    public ?int $licenseKeyActivationsUsed;

    #[Optional('license_key_expires_at', nullable: true)]
    public ?\DateTimeInterface $licenseKeyExpiresAt;

    #[Optional('license_key_status', nullable: true)]
    public ?string $licenseKeyStatus;

    #[Optional]
    public mixed $metadata;

    #[Optional('oauth_expires_at', nullable: true)]
    public ?\DateTimeInterface $oauthExpiresAt;

    #[Optional('oauth_url', nullable: true)]
    public ?string $oauthURL;

    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    #[Optional('revocation_reason', nullable: true)]
    public ?string $revocationReason;

    #[Optional('revoked_at', nullable: true)]
    public ?\DateTimeInterface $revokedAt;

    #[Optional('subscription_id', nullable: true)]
    public ?string $subscriptionID;

    /**
     * `new EntitlementGrant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementGrant::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   customerID: ...,
     *   entitlementID: ...,
     *   externalID: ...,
     *   payloadType: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementGrant)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerID(...)
     *   ->withEntitlementID(...)
     *   ->withExternalID(...)
     *   ->withPayloadType(...)
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
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
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        string $entitlementID,
        string $externalID,
        PayloadType|string $payloadType,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        ?\DateTimeInterface $deliveredAt = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        ?string $licenseKey = null,
        ?int $licenseKeyActivationsLimit = null,
        ?int $licenseKeyActivationsUsed = null,
        ?\DateTimeInterface $licenseKeyExpiresAt = null,
        ?string $licenseKeyStatus = null,
        mixed $metadata = null,
        ?\DateTimeInterface $oauthExpiresAt = null,
        ?string $oauthURL = null,
        ?string $paymentID = null,
        ?string $revocationReason = null,
        ?\DateTimeInterface $revokedAt = null,
        ?string $subscriptionID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['businessID'] = $businessID;
        $self['createdAt'] = $createdAt;
        $self['customerID'] = $customerID;
        $self['entitlementID'] = $entitlementID;
        $self['externalID'] = $externalID;
        $self['payloadType'] = $payloadType;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        null !== $deliveredAt && $self['deliveredAt'] = $deliveredAt;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $licenseKey && $self['licenseKey'] = $licenseKey;
        null !== $licenseKeyActivationsLimit && $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;
        null !== $licenseKeyActivationsUsed && $self['licenseKeyActivationsUsed'] = $licenseKeyActivationsUsed;
        null !== $licenseKeyExpiresAt && $self['licenseKeyExpiresAt'] = $licenseKeyExpiresAt;
        null !== $licenseKeyStatus && $self['licenseKeyStatus'] = $licenseKeyStatus;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $oauthExpiresAt && $self['oauthExpiresAt'] = $oauthExpiresAt;
        null !== $oauthURL && $self['oauthURL'] = $oauthURL;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $revocationReason && $self['revocationReason'] = $revocationReason;
        null !== $revokedAt && $self['revokedAt'] = $revokedAt;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withEntitlementID(string $entitlementID): self
    {
        $self = clone $this;
        $self['entitlementID'] = $entitlementID;

        return $self;
    }

    public function withExternalID(string $externalID): self
    {
        $self = clone $this;
        $self['externalID'] = $externalID;

        return $self;
    }

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    public function withErrorCode(?string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    public function withErrorMessage(?string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    public function withLicenseKey(?string $licenseKey): self
    {
        $self = clone $this;
        $self['licenseKey'] = $licenseKey;

        return $self;
    }

    public function withLicenseKeyActivationsLimit(
        ?int $licenseKeyActivationsLimit
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationsLimit'] = $licenseKeyActivationsLimit;

        return $self;
    }

    public function withLicenseKeyActivationsUsed(
        ?int $licenseKeyActivationsUsed
    ): self {
        $self = clone $this;
        $self['licenseKeyActivationsUsed'] = $licenseKeyActivationsUsed;

        return $self;
    }

    public function withLicenseKeyExpiresAt(
        ?\DateTimeInterface $licenseKeyExpiresAt
    ): self {
        $self = clone $this;
        $self['licenseKeyExpiresAt'] = $licenseKeyExpiresAt;

        return $self;
    }

    public function withLicenseKeyStatus(?string $licenseKeyStatus): self
    {
        $self = clone $this;
        $self['licenseKeyStatus'] = $licenseKeyStatus;

        return $self;
    }

    public function withMetadata(mixed $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withOAuthExpiresAt(
        ?\DateTimeInterface $oauthExpiresAt
    ): self {
        $self = clone $this;
        $self['oauthExpiresAt'] = $oauthExpiresAt;

        return $self;
    }

    public function withOAuthURL(?string $oauthURL): self
    {
        $self = clone $this;
        $self['oauthURL'] = $oauthURL;

        return $self;
    }

    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    public function withRevocationReason(?string $revocationReason): self
    {
        $self = clone $this;
        $self['revocationReason'] = $revocationReason;

        return $self;
    }

    public function withRevokedAt(?\DateTimeInterface $revokedAt): self
    {
        $self = clone $this;
        $self['revokedAt'] = $revokedAt;

        return $self;
    }

    public function withSubscriptionID(?string $subscriptionID): self
    {
        $self = clone $this;
        $self['subscriptionID'] = $subscriptionID;

        return $self;
    }
}
