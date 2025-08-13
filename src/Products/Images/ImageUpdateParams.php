<?php

declare(strict_types=1);

namespace DodoPayments\Products\Images;

use DodoPayments\Core\Attributes\Api;
use DodoPayments\Core\Concerns\Model;
use DodoPayments\Core\Concerns\Params;
use DodoPayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type update_params = array{forceUpdate?: bool}
 */
final class ImageUpdateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?bool $forceUpdate;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(?bool $forceUpdate = null): self
    {
        $obj = new self;

        null !== $forceUpdate && $obj->forceUpdate = $forceUpdate;

        return $obj;
    }

    public function setForceUpdate(bool $forceUpdate): self
    {
        $this->forceUpdate = $forceUpdate;

        return $this;
    }
}
