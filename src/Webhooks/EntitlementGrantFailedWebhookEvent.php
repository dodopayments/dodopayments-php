<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Entitlements\Grants\EntitlementGrant;

/**
 * @phpstan-import-type EntitlementGrantShape from \Dodopayments\Entitlements\Grants\EntitlementGrant
 *
 * @phpstan-type EntitlementGrantFailedWebhookEventShape = array{
 *   businessID: string,
 *   data: EntitlementGrant|EntitlementGrantShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'entitlement_grant.failed',
 * }
 */
final class EntitlementGrantFailedWebhookEvent implements BaseModel
{
    /** @use SdkModel<EntitlementGrantFailedWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'entitlement_grant.failed' $type
     */
    #[Required]
    public string $type = 'entitlement_grant.failed';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    /**
     * Detailed view of a single entitlement grant: who it's for, its
     * lifecycle state, and any integration-specific delivery payload.
     */
    #[Required]
    public EntitlementGrant $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new EntitlementGrantFailedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntitlementGrantFailedWebhookEvent::with(
     *   businessID: ..., data: ..., timestamp: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntitlementGrantFailedWebhookEvent)
     *   ->withBusinessID(...)
     *   ->withData(...)
     *   ->withTimestamp(...)
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
     * @param EntitlementGrant|EntitlementGrantShape $data
     */
    public static function with(
        string $businessID,
        EntitlementGrant|array $data,
        \DateTimeInterface $timestamp,
    ): self {
        $self = new self;

        $self['businessID'] = $businessID;
        $self['data'] = $data;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The business identifier.
     */
    public function withBusinessID(string $businessID): self
    {
        $self = clone $this;
        $self['businessID'] = $businessID;

        return $self;
    }

    /**
     * Detailed view of a single entitlement grant: who it's for, its
     * lifecycle state, and any integration-specific delivery payload.
     *
     * @param EntitlementGrant|EntitlementGrantShape $data
     */
    public function withData(EntitlementGrant|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The timestamp of when the event occurred.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The event type.
     *
     * @param 'entitlement_grant.failed' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
