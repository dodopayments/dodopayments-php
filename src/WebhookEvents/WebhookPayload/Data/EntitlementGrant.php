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
 * Detailed view of a single entitlement grant: who it's for, its
 * lifecycle state, and any integration-specific delivery payload.
 *
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\DigitalProductDelivery
 * @phpstan-import-type LicenseKeyGrantShape from \Dodopayments\Entitlements\Grants\LicenseKeyGrant
 *
 * @phpstan-type EntitlementGrantShape = array{
 *   id: string,
 *   businessID: string,
 *   createdAt: \DateTimeInterface,
 *   customerID: string,
 *   entitlementID: string,
 *   metadata: array<string,string>,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   deliveredAt?: \DateTimeInterface|null,
 *   digitalProductDelivery?: null|DigitalProductDelivery|DigitalProductDeliveryShape,
 *   errorCode?: string|null,
 *   errorMessage?: string|null,
 *   licenseKey?: null|LicenseKeyGrant|LicenseKeyGrantShape,
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

    /**
     * Unique identifier of the grant.
     */
    #[Required]
    public string $id;

    /**
     * Identifier of the business that owns the grant.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Timestamp when the grant was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Identifier of the customer the grant was issued to.
     */
    #[Required('customer_id')]
    public string $customerID;

    /**
     * Identifier of the entitlement this grant was issued from.
     */
    #[Required('entitlement_id')]
    public string $entitlementID;

    /**
     * Arbitrary key-value metadata recorded on the grant.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Lifecycle status of the grant.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Timestamp when the grant was last modified.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Timestamp when the grant transitioned to `delivered`, when applicable.
     */
    #[Optional('delivered_at', nullable: true)]
    public ?\DateTimeInterface $deliveredAt;

    /**
     * Digital-product-delivery payload, present on grants for `digital_files`
     * entitlements. Each file carries a short-lived presigned download URL.
     */
    #[Optional('digital_product_delivery')]
    public ?DigitalProductDelivery $digitalProductDelivery;

    /**
     * Machine-readable code reported when delivery failed, when applicable.
     */
    #[Optional('error_code', nullable: true)]
    public ?string $errorCode;

    /**
     * Human-readable message reported when delivery failed, when applicable.
     */
    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    /**
     * License-key delivery payload, present on grants for `license_key`
     * entitlements. The grant's top-level `status` is the source of truth
     * for the grant's lifecycle.
     */
    #[Optional('license_key')]
    public ?LicenseKeyGrant $licenseKey;

    /**
     * Timestamp when `oauth_url` stops being valid, when applicable.
     */
    #[Optional('oauth_expires_at', nullable: true)]
    public ?\DateTimeInterface $oauthExpiresAt;

    /**
     * Customer-facing OAuth URL for OAuth-style integrations. Populated
     * during the customer-portal accept flow; `null` until the customer
     * completes that step, and on grants for non-OAuth integrations.
     */
    #[Optional('oauth_url', nullable: true)]
    public ?string $oauthURL;

    /**
     * Identifier of the payment that triggered this grant, when applicable.
     */
    #[Optional('payment_id', nullable: true)]
    public ?string $paymentID;

    /**
     * Reason recorded when the grant was revoked, when applicable.
     */
    #[Optional('revocation_reason', nullable: true)]
    public ?string $revocationReason;

    /**
     * Timestamp when the grant transitioned to `revoked`, when applicable.
     */
    #[Optional('revoked_at', nullable: true)]
    public ?\DateTimeInterface $revokedAt;

    /**
     * Identifier of the subscription that triggered this grant, when applicable.
     */
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
     *   metadata: ...,
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
     *   ->withMetadata(...)
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
     * @param array<string,string> $metadata
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
        array $metadata,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        PayloadType|string $payloadType,
        ?\DateTimeInterface $deliveredAt = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        LicenseKeyGrant|array|null $licenseKey = null,
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
        $self['metadata'] = $metadata;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;
        $self['payloadType'] = $payloadType;

        null !== $deliveredAt && $self['deliveredAt'] = $deliveredAt;
        null !== $digitalProductDelivery && $self['digitalProductDelivery'] = $digitalProductDelivery;
        null !== $errorCode && $self['errorCode'] = $errorCode;
        null !== $errorMessage && $self['errorMessage'] = $errorMessage;
        null !== $licenseKey && $self['licenseKey'] = $licenseKey;
        null !== $oauthExpiresAt && $self['oauthExpiresAt'] = $oauthExpiresAt;
        null !== $oauthURL && $self['oauthURL'] = $oauthURL;
        null !== $paymentID && $self['paymentID'] = $paymentID;
        null !== $revocationReason && $self['revocationReason'] = $revocationReason;
        null !== $revokedAt && $self['revokedAt'] = $revokedAt;
        null !== $subscriptionID && $self['subscriptionID'] = $subscriptionID;

        return $self;
    }

    /**
     * Unique identifier of the grant.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Identifier of the business that owns the grant.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Timestamp when the grant was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Identifier of the customer the grant was issued to.
     */
    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * Identifier of the entitlement this grant was issued from.
     */
    public function withEntitlementID(string $entitlementID): self
    {
        $self = clone $this;
        $self['entitlementID'] = $entitlementID;

        return $self;
    }

    /**
     * Arbitrary key-value metadata recorded on the grant.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Lifecycle status of the grant.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Timestamp when the grant was last modified.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Timestamp when the grant transitioned to `delivered`, when applicable.
     */
    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    /**
     * Digital-product-delivery payload, present on grants for `digital_files`
     * entitlements. Each file carries a short-lived presigned download URL.
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

    /**
     * Machine-readable code reported when delivery failed, when applicable.
     */
    public function withErrorCode(?string $errorCode): self
    {
        $self = clone $this;
        $self['errorCode'] = $errorCode;

        return $self;
    }

    /**
     * Human-readable message reported when delivery failed, when applicable.
     */
    public function withErrorMessage(?string $errorMessage): self
    {
        $self = clone $this;
        $self['errorMessage'] = $errorMessage;

        return $self;
    }

    /**
     * License-key delivery payload, present on grants for `license_key`
     * entitlements. The grant's top-level `status` is the source of truth
     * for the grant's lifecycle.
     *
     * @param LicenseKeyGrant|LicenseKeyGrantShape $licenseKey
     */
    public function withLicenseKey(LicenseKeyGrant|array $licenseKey): self
    {
        $self = clone $this;
        $self['licenseKey'] = $licenseKey;

        return $self;
    }

    /**
     * Timestamp when `oauth_url` stops being valid, when applicable.
     */
    public function withOAuthExpiresAt(
        ?\DateTimeInterface $oauthExpiresAt
    ): self {
        $self = clone $this;
        $self['oauthExpiresAt'] = $oauthExpiresAt;

        return $self;
    }

    /**
     * Customer-facing OAuth URL for OAuth-style integrations. Populated
     * during the customer-portal accept flow; `null` until the customer
     * completes that step, and on grants for non-OAuth integrations.
     */
    public function withOAuthURL(?string $oauthURL): self
    {
        $self = clone $this;
        $self['oauthURL'] = $oauthURL;

        return $self;
    }

    /**
     * Identifier of the payment that triggered this grant, when applicable.
     */
    public function withPaymentID(?string $paymentID): self
    {
        $self = clone $this;
        $self['paymentID'] = $paymentID;

        return $self;
    }

    /**
     * Reason recorded when the grant was revoked, when applicable.
     */
    public function withRevocationReason(?string $revocationReason): self
    {
        $self = clone $this;
        $self['revocationReason'] = $revocationReason;

        return $self;
    }

    /**
     * Timestamp when the grant transitioned to `revoked`, when applicable.
     */
    public function withRevokedAt(?\DateTimeInterface $revokedAt): self
    {
        $self = clone $this;
        $self['revokedAt'] = $revokedAt;

        return $self;
    }

    /**
     * Identifier of the subscription that triggered this grant, when applicable.
     */
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
