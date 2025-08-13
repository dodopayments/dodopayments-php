<?php

declare(strict_types=1);

namespace Dodopayments\Responses\LicenseKeyInstances;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\LicenseKeyInstances\LicenseKeyInstance;

/**
 * @phpstan-type license_key_instance_list_response_item_alias = array{
 *   items: list<LicenseKeyInstance>
 * }
 */
final class LicenseKeyInstanceListResponseItem implements BaseModel
{
    use Model;

    /** @var list<LicenseKeyInstance> $items */
    #[Api(type: new ListOf(LicenseKeyInstance::class))]
    public array $items;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<LicenseKeyInstance> $items
     */
    public static function from(array $items): self
    {
        $obj = new self;

        $obj->items = $items;

        return $obj;
    }

    /**
     * @param list<LicenseKeyInstance> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
