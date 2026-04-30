<?php

declare(strict_types=1);

namespace Dodopayments\Entitlements\Files;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Companion to `post_entitlement_file`. Deletes the file from the
 * Entitlements Engine (force=true) and atomically removes the `file_id`
 * from the entitlement's `integration_config.digital_file_ids` JSONB
 * array. EE delete happens first; if it fails we surface the error and
 * leave local state untouched.
 *
 * @see Dodopayments\Services\Entitlements\FilesService::delete()
 *
 * @phpstan-type FileDeleteParamsShape = array{id: string}
 */
final class FileDeleteParams implements BaseModel
{
    /** @use SdkModel<FileDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /**
     * `new FileDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FileDeleteParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FileDeleteParams)->withID(...)
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
