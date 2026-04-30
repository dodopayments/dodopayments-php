<?php

declare(strict_types=1);

namespace Dodopayments\WebhookEvents\WebhookPayload\Data;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\Grants\EntitlementGrant\Status;
use Dodopayments\Entitlements\Grants\LicenseKeyGrant;
use Dodopayments\Products\DigitalProductDelivery;
use Dodopayments\WebhookEvents\WebhookPayload\Data\EntitlementGrant\PayloadType;

/**
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\DigitalProductDelivery
 * @phpstan-import-type LicenseKeyGrantShape from \Dodopayments\Entitlements\Grants\LicenseKeyGrant
 *
 * @phpstan-type EntitlementGrantShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   entitlementID: string,
 *   externalID: string,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   deliveredAt?: \DateTimeInterface|null,
 *   digitalProductDelivery?: null|DigitalProductDelivery|DigitalProductDeliveryShape,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   licenseKey?: null|LicenseKeyGrant|LicenseKeyGrantShape,
 *   metadata?: mixed,
 *   oauthExpiresAt?: \DateTimeInterface|null,
 *   oauthURL?: string|null,
 *   paymentID?: string|null,
 *   revocationReason?: string|null,
 *   revokedAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 *   payloadType: PayloadType|value-of<PayloadType>,
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

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('delivered_at', nullable: true)]
    public ?\DateTimeInterface $deliveredAt;

    /**
     * Digital-product-delivery payload for a grant. Populated for grants whose
     * entitlement has `integration_type = 'digital_files'`. `files` carries
     * presigned download URLs; the source (EE service or legacy in-process S3
     * presigning) is opaque to the caller.
     */
    #[Optional('digital_product_delivery')]
    public ?DigitalProductDelivery $digitalProductDelivery;

    #[Optional('error_code', nullable: true)]
    public ?string $errorCode;

    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    /**
     * Nested representation of license-key grant fields. Present only when the
     * grant's entitlement has `integration_type = 'license_key'` and a row exists
     * in `license_keys`. The grant's top-level `status` is the source of truth
     * for the grant's lifecycle — no per-license-key status is exposed here.
     */
    #[Optional('license_key')]
    public ?LicenseKeyGrant $licenseKey;

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

    /** @var value-of<PayloadType> $payloadType */
    #[Required('payload_type', enum: PayloadType::class)]
    public string $payloadType;

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
     *   status: ...,
     *   updatedAt: ...,
     *   payloadType: ...,
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
     *   ->withStatus(...)
     *   ->withUpdatedAt(...)
     *   ->withPayloadType(...)
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
     * @param Status|value-of<Status> $status
     * @param PayloadType|value-of<PayloadType> $payloadType
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery
     * @param LicenseKeyGrant|LicenseKeyGrantShape|null $licenseKey
     */
    public static function with(
        string $id,
        string $businessID,
        \DateTimeInterface $createdAt,
        string $customerID,
        string $entitlementID,
        string $externalID,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        PayloadType|string $payloadType,
        ?\DateTimeInterface $deliveredAt = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        LicenseKeyGrant|array|null $licenseKey = null,
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
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['payloadType'] = $payloadType;

        null !== $deliveredAt && $self['deliveredAt'] = $deliveredAt;
        null !== $digitalProductDelivery && $self['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $licenseKey && $self['licenseKey'] = $licenseKey;
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

    /**
     * Digital-product-delivery payload for a grant. Populated for grants whose
     * entitlement has `integration_type = 'digital_files'`. `files` carries
     * presigned download URLs; the source (EE service or legacy in-process S3
     * presigning) is opaque to the caller.
     *
     * @param DigitalProductDelivery|DigitalProductDeliveryShape $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array $digitalProductDelivery
    ): self {
        $self = clone $this;
        $self['digitalProductDelivery'] = $digitalProductDelivery;

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

    /**
     * Nested representation of license-key grant fields. Present only when the
     * grant's entitlement has `integration_type = 'license_key'` and a row exists
     * in `license_keys`. The grant's top-level `status` is the source of truth
     * for the grant's lifecycle — no per-license-key status is exposed here.
     *
     * @param LicenseKeyGrant|LicenseKeyGrantShape $licenseKey
     */
    public function withLicenseKey(LicenseKeyGrant|array $licenseKey): self
    {
        $self = clone $this;
        $self['licenseKey'] = $licenseKey;

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

    /**
     * @param PayloadType|value-of<PayloadType> $payloadType
     */
    public function withPayloadType(PayloadType|string $payloadType): self
    {
        $self = clone $this;
        $self['payloadType'] = $payloadType;

        return $self;
    }
}
