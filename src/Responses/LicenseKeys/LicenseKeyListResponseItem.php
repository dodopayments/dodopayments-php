<?php

declare(strict_types=1);

namespace Dodopayments\Responses\LicenseKeys;

use Dodopayments\Core\Attributes\Api;
use Dodopayments\Core\Concerns\Model;
use Dodopayments\Core\Contracts\BaseModel;
use Dodopayments\Core\Conversion\ListOf;
use Dodopayments\LicenseKeys\LicenseKey;

/**
 * @phpstan-type license_key_list_response_item_alias = array{
 *   items: list<LicenseKey>
 * }
 */
final class LicenseKeyListResponseItem implements BaseModel
{
    use Model;

    /** @var list<LicenseKey> $items */
    #[Api(type: new ListOf(LicenseKey::class))]
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
     * @param list<LicenseKey> $items
     */
    public static function from(array $items): self
    {
        $obj = new self;

        $obj->items = $items;

        return $obj;
    }

    /**
     * @param list<LicenseKey> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
