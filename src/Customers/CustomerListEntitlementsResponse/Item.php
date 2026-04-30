<?php

declare(strict_types=1);

namespace Dodopayments\Customers\CustomerListEntitlementsResponse;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Customers\CustomerListEntitlementsResponse\Item\IntegrationType;
use Dodopayments\Customers\CustomerListEntitlementsResponse\Item\Status;

/**
 * @phpstan-type ItemShape = array{
 *   createdAt: \DateTimeInterface,
 *   entitlementID: string,
 *   entitlementName: string,
 *   grantID: string,
 *   integrationType: IntegrationType|value-of<IntegrationType>,
 *   status: Status|value-of<Status>,
 *   updatedAt: \DateTimeInterface,
 *   deliveredAt?: \DateTimeInterface|null,
 *   entitlementDescription?: string|null,
 *   revokedAt?: \DateTimeInterface|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The entitlement this grant belongs to.
     */
    #[Required('entitlement_id')]
    public string $entitlementID;

    #[Required('entitlement_name')]
    public string $entitlementName;

    /**
     * Grant id (the per-customer row in `entitlement_grants`).
     */
    #[Required('grant_id')]
    public string $grantID;

    /** @var value-of<IntegrationType> $integrationType */
    #[Required('integration_type', enum: IntegrationType::class)]
    public string $integrationType;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('delivered_at', nullable: true)]
    public ?\DateTimeInterface $deliveredAt;

    #[Optional('entitlement_description', nullable: true)]
    public ?string $entitlementDescription;

    #[Optional('revoked_at', nullable: true)]
    public ?\DateTimeInterface $revokedAt;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   createdAt: ...,
     *   entitlementID: ...,
     *   entitlementName: ...,
     *   grantID: ...,
     *   integrationType: ...,
     *   status: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withCreatedAt(...)
     *   ->withEntitlementID(...)
     *   ->withEntitlementName(...)
     *   ->withGrantID(...)
     *   ->withIntegrationType(...)
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
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     * @param Status|value-of<Status> $status
     */
    public static function with(
        \DateTimeInterface $createdAt,
        string $entitlementID,
        string $entitlementName,
        string $grantID,
        IntegrationType|string $integrationType,
        Status|string $status,
        \DateTimeInterface $updatedAt,
        ?\DateTimeInterface $deliveredAt = null,
        ?string $entitlementDescription = null,
        ?\DateTimeInterface $revokedAt = null,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['entitlementID'] = $entitlementID;
        $self['entitlementName'] = $entitlementName;
        $self['grantID'] = $grantID;
        $self['integrationType'] = $integrationType;
        $self['status'] = $status;
        $self['updatedAt'] = $updatedAt;

        null !== $deliveredAt && $self['deliveredAt'] = $deliveredAt;
        null !== $entitlementDescription && $self['entitlementDescription'] = $entitlementDescription;
        null !== $revokedAt && $self['revokedAt'] = $revokedAt;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The entitlement this grant belongs to.
     */
    public function withEntitlementID(string $entitlementID): self
    {
        $self = clone $this;
        $self['entitlementID'] = $entitlementID;

        return $self;
    }

    public function withEntitlementName(string $entitlementName): self
    {
        $self = clone $this;
        $self['entitlementName'] = $entitlementName;

        return $self;
    }

    /**
     * Grant id (the per-customer row in `entitlement_grants`).
     */
    public function withGrantID(string $grantID): self
    {
        $self = clone $this;
        $self['grantID'] = $grantID;

        return $self;
    }

    /**
     * @param IntegrationType|value-of<IntegrationType> $integrationType
     */
    public function withIntegrationType(
        IntegrationType|string $integrationType
    ): self {
        $self = clone $this;
        $self['integrationType'] = $integrationType;

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

    public function withEntitlementDescription(
        ?string $entitlementDescription
    ): self {
        $self = clone $this;
        $self['entitlementDescription'] = $entitlementDescription;

        return $self;
    }

    public function withRevokedAt(?\DateTimeInterface $revokedAt): self
    {
        $self = clone $this;
        $self['revokedAt'] = $revokedAt;

        return $self;
    }
}
