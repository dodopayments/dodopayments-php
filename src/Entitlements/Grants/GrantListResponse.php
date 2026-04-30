<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\Grants\GrantListResponse\LicenseKey;
use Dodopayments\Entitlements\Grants\GrantListResponse\Status;
use Dodopayments\Products\DigitalProductDelivery;

/**
 * @phpstan-import-type DigitalProductDeliveryShape from \Dodopayments\Products\DigitalProductDelivery
 * @phpstan-import-type LicenseKeyShape from \Dodopayments\Entitlements\Grants\GrantListResponse\LicenseKey
 *
 * @phpstan-type GrantListResponseShape = array{
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
 *   licenseKey?: null|LicenseKey|LicenseKeyShape,
 *   metadata?: mixed,
 *   oauthExpiresAt?: \DateTimeInterface|null,
 *   oauthURL?: string|null,
 *   paymentID?: string|null,
 *   revocationReason?: string|null,
 *   revokedAt?: \DateTimeInterface|null,
 *   subscriptionID?: string|null,
 * }
 */
final class GrantListResponse implements BaseModel
{
    /** @use SdkModel<GrantListResponseShape> */
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
     * Present only when the entitlement integration_type is `digital_files`.
     * Populated eagerly on every list and single-record endpoint.
     */
    #[Optional('digital_product_delivery', nullable: true)]
    public ?DigitalProductDelivery $digitalProductDelivery;

    #[Optional('error_code', nullable: true)]
    public ?string $errorCode;

    #[Optional('error_message', nullable: true)]
    public ?string $errorMessage;

    /**
     * Present only when the entitlement integration_type is `license_key`.
     */
    #[Optional('license_key', nullable: true)]
    public ?LicenseKey $licenseKey;

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
     * `new GrantListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GrantListResponse::with(
     *   id: ...,
     *   businessID: ...,
     *   createdAt: ...,
     *   customerID: ...,
     *   entitlementID: ...,
     *   externalID: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GrantListResponse)
     *   ->withID(...)
     *   ->withBusinessID(...)
     *   ->withCreatedAt(...)
     *   ->withCustomerID(...)
     *   ->withEntitlementID(...)
     *   ->withExternalID(...)
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
     * @param Status|value-of<Status> $status
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery
     * @param LicenseKey|LicenseKeyShape|null $licenseKey
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
        ?\DateTimeInterface $deliveredAt = null,
        DigitalProductDelivery|array|null $digitalProductDelivery = null,
        ?string $errorCode = null,
        ?string $errorMessage = null,
        LicenseKey|array|null $licenseKey = null,
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
     * Present only when the entitlement integration_type is `digital_files`.
     * Populated eagerly on every list and single-record endpoint.
     *
     * @param DigitalProductDelivery|DigitalProductDeliveryShape|null $digitalProductDelivery
     */
    public function withDigitalProductDelivery(
        DigitalProductDelivery|array|null $digitalProductDelivery
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
     * Present only when the entitlement integration_type is `license_key`.
     *
     * @param LicenseKey|LicenseKeyShape|null $licenseKey
     */
    public function withLicenseKey(LicenseKey|array|null $licenseKey): self
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
}
