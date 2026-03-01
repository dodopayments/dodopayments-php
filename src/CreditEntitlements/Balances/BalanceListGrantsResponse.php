<?php

declare(strict_types=1);

namespace Dodopayments\CreditEntitlements\Balances;

use Dodopayments\Core\Attributes\Optional;
use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\CreditEntitlements\Balances\BalanceListGrantsResponse\SourceType;

/**
 * Response for a credit grant.
 *
 * @phpstan-type BalanceListGrantsResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   creditEntitlementID: string,
 *   customerID: string,
 *   initialAmount: string,
 *   isExpired: bool,
 *   isRolledOver: bool,
 *   remainingAmount: string,
 *   rolloverCount: int,
 *   sourceType: SourceType|value-of<SourceType>,
 *   updatedAt: \DateTimeInterface,
 *   expiresAt?: \DateTimeInterface|null,
 *   metadata?: array<string,string>|null,
 *   parentGrantID?: string|null,
 *   sourceID?: string|null,
 * }
 */
final class BalanceListGrantsResponse implements BaseModel
{
    /** @use SdkModel<BalanceListGrantsResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    #[Required('credit_entitlement_id')]
    public string $creditEntitlementID;

    #[Required('customer_id')]
    public string $customerID;

    #[Required('initial_amount')]
    public string $initialAmount;

    #[Required('is_expired')]
    public bool $isExpired;

    #[Required('is_rolled_over')]
    public bool $isRolledOver;

    #[Required('remaining_amount')]
    public string $remainingAmount;

    #[Required('rollover_count')]
    public int $rolloverCount;

    /** @var value-of<SourceType> $sourceType */
    #[Required('source_type', enum: SourceType::class)]
    public string $sourceType;

    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /** @var array<string,string>|null $metadata */
    #[Optional(map: 'string', nullable: true)]
    public ?array $metadata;

    #[Optional('parent_grant_id', nullable: true)]
    public ?string $parentGrantID;

    #[Optional('source_id', nullable: true)]
    public ?string $sourceID;

    /**
     * `new BalanceListGrantsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BalanceListGrantsResponse::with(
     *   id: ...,
     *   createdAt: ...,
     *   creditEntitlementID: ...,
     *   customerID: ...,
     *   initialAmount: ...,
     *   isExpired: ...,
     *   isRolledOver: ...,
     *   remainingAmount: ...,
     *   rolloverCount: ...,
     *   sourceType: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BalanceListGrantsResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withCreditEntitlementID(...)
     *   ->withCustomerID(...)
     *   ->withInitialAmount(...)
     *   ->withIsExpired(...)
     *   ->withIsRolledOver(...)
     *   ->withRemainingAmount(...)
     *   ->withRolloverCount(...)
     *   ->withSourceType(...)
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
     * @param SourceType|value-of<SourceType> $sourceType
     * @param array<string,string>|null $metadata
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        string $creditEntitlementID,
        string $customerID,
        string $initialAmount,
        bool $isExpired,
        bool $isRolledOver,
        string $remainingAmount,
        int $rolloverCount,
        SourceType|string $sourceType,
        \DateTimeInterface $updatedAt,
        ?\DateTimeInterface $expiresAt = null,
        ?array $metadata = null,
        ?string $parentGrantID = null,
        ?string $sourceID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['creditEntitlementID'] = $creditEntitlementID;
        $self['customerID'] = $customerID;
        $self['initialAmount'] = $initialAmount;
        $self['isExpired'] = $isExpired;
        $self['isRolledOver'] = $isRolledOver;
        $self['remainingAmount'] = $remainingAmount;
        $self['rolloverCount'] = $rolloverCount;
        $self['sourceType'] = $sourceType;
        $self['updatedAt'] = $updatedAt;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $parentGrantID && $self['parentGrantID'] = $parentGrantID;
        null !== $sourceID && $self['sourceID'] = $sourceID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withCreditEntitlementID(string $creditEntitlementID): self
    {
        $self = clone $this;
        $self['creditEntitlementID'] = $creditEntitlementID;

        return $self;
    }

    public function withCustomerID(string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    public function withInitialAmount(string $initialAmount): self
    {
        $self = clone $this;
        $self['initialAmount'] = $initialAmount;

        return $self;
    }

    public function withIsExpired(bool $isExpired): self
    {
        $self = clone $this;
        $self['isExpired'] = $isExpired;

        return $self;
    }

    public function withIsRolledOver(bool $isRolledOver): self
    {
        $self = clone $this;
        $self['isRolledOver'] = $isRolledOver;

        return $self;
    }

    public function withRemainingAmount(string $remainingAmount): self
    {
        $self = clone $this;
        $self['remainingAmount'] = $remainingAmount;

        return $self;
    }

    public function withRolloverCount(int $rolloverCount): self
    {
        $self = clone $this;
        $self['rolloverCount'] = $rolloverCount;

        return $self;
    }

    /**
     * @param SourceType|value-of<SourceType> $sourceType
     */
    public function withSourceType(SourceType|string $sourceType): self
    {
        $self = clone $this;
        $self['sourceType'] = $sourceType;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * @param array<string,string>|null $metadata
     */
    public function withMetadata(?array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    public function withParentGrantID(?string $parentGrantID): self
    {
        $self = clone $this;
        $self['parentGrantID'] = $parentGrantID;

        return $self;
    }

    public function withSourceID(?string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }
}
