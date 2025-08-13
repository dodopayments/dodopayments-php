<?php

declare(strict_types=1);

namespace DodopaymentsClient\Brands;

use DodopaymentsClient\Core\Attributes\Api;
use DodopaymentsClient\Core\Concerns\Model;
use DodopaymentsClient\Core\Concerns\Params;
use DodopaymentsClient\Core\Contracts\BaseModel;

/**
 * @phpstan-type create_params = array{
 *   description?: string|null,
 *   name?: string|null,
 *   statementDescriptor?: string|null,
 *   supportEmail?: string|null,
 *   url?: string|null,
 * }
 */
final class BrandCreateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?string $description;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('statement_descriptor', optional: true)]
    public ?string $statementDescriptor;

    #[Api('support_email', optional: true)]
    public ?string $supportEmail;

    #[Api(optional: true)]
    public ?string $url;

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
    public static function from(
        ?string $description = null,
        ?string $name = null,
        ?string $statementDescriptor = null,
        ?string $supportEmail = null,
        ?string $url = null,
    ): self {
        $obj = new self;

        null !== $description && $obj->description = $description;
        null !== $name && $obj->name = $name;
        null !== $statementDescriptor && $obj->statementDescriptor = $statementDescriptor;
        null !== $supportEmail && $obj->supportEmail = $supportEmail;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setStatementDescriptor(?string $statementDescriptor): self
    {
        $this->statementDescriptor = $statementDescriptor;

        return $this;
    }

    public function setSupportEmail(?string $supportEmail): self
    {
        $this->supportEmail = $supportEmail;

        return $this;
    }

    public function setURL(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
