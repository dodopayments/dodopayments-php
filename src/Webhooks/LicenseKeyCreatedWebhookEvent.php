<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\LicenseKeys\LicenseKey;

/**
 * @phpstan-import-type LicenseKeyShape from \Dodopayments\LicenseKeys\LicenseKey
 *
 * @phpstan-type LicenseKeyCreatedWebhookEventShape = array{
 *   businessID: string,
 *   data: LicenseKey|LicenseKeyShape,
 *   timestamp: \DateTimeInterface,
 *   type: 'license_key.created',
 * }
 */
final class LicenseKeyCreatedWebhookEvent implements BaseModel
{
    /** @use SdkModel<LicenseKeyCreatedWebhookEventShape> */
    use SdkModel;

    /**
     * The event type.
     *
     * @var 'license_key.created' $type
     */
    #[Required]
    public string $type = 'license_key.created';

    /**
     * The business identifier.
     */
    #[Required('business_id')]
    public string $businessID;

    #[Required]
    public LicenseKey $data;

    /**
     * The timestamp of when the event occurred.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new LicenseKeyCreatedWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LicenseKeyCreatedWebhookEvent::with(businessID: ..., data: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LicenseKeyCreatedWebhookEvent)
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
     * @param LicenseKey|LicenseKeyShape $data
     */
    public static function with(
        string $businessID,
        LicenseKey|array $data,
        \DateTimeInterface $timestamp
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
     * @param LicenseKey|LicenseKeyShape $data
     */
    public function withData(LicenseKey|array $data): self
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
     * @param 'license_key.created' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
