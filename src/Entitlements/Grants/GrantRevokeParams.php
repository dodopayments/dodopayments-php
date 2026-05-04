<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Grants;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Revoke a single grant. Idempotent: re-revoking an already-revoked
 * grant returns the grant in its current state.
 *
 * @see Dodopayments\Services\Entitlements\GrantsService::revoke()
 *
 * @phpstan-type GrantRevokeParamsShape = array{id: string}
 */
final class GrantRevokeParams implements BaseModel
{
    /** @use SdkModel<GrantRevokeParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new GrantRevokeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GrantRevokeParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GrantRevokeParams)->withID(...)
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
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
