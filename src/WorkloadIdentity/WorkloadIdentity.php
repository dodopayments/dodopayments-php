<?php

declare(strict_types=1);

namespace Dodopayments\WorkloadIdentity;

use Dodopayments\Core\Util;

/**
 * The workload identity options of the client.
 *
 * The client exchanges a JWT from the identity provider of your workload for a
 * short-lived access token.
 */
final class WorkloadIdentity
{
    public const IDENTITY_PROVIDER_ID_ENV = 'DODO_PAYMENTS_IDENTITY_PROVIDER_ID';

    /** @var \Closure(string): string */
    public readonly \Closure $provider;

    public readonly string $identityProviderId;

    /**
     * @param (callable(string): string)|null $provider returns the subject token (a JWT). The client gives it the base URL. The default is Providers::auto().
     * @param string|null $identityProviderId the "wip_" ID of the identity provider. The default is the DODO_PAYMENTS_IDENTITY_PROVIDER_ID environment variable.
     */
    public function __construct(
        ?callable $provider = null,
        ?string $identityProviderId = null,
    ) {
        $provider ??= Providers::auto();
        if (null === $provider) {
            throw new WorkloadIdentityException('No subject token source found. Set the provider option.');
        }
        $this->provider = $provider(...);

        $identityProviderId ??= Util::getenv(self::IDENTITY_PROVIDER_ID_ENV);
        if (null === $identityProviderId || '' === $identityProviderId) {
            throw new WorkloadIdentityException('Set identityProviderId or the '.self::IDENTITY_PROVIDER_ID_ENV.' environment variable.');
        }
        $this->identityProviderId = $identityProviderId;
    }
}
