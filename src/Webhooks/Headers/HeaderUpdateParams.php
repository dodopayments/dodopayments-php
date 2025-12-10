<?php

declare(strict_types=1);

namespace Dodopayments\Webhooks\Headers;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Concerns\SdkParams;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * Patch a webhook by id.
 *
 * @see Dodopayments\Services\Webhooks\HeadersService::update()
 *
 * @phpstan-type HeaderUpdateParamsShape = array{headers: array<string,string>}
 */
final class HeaderUpdateParams implements BaseModel
{
    /** @use SdkModel<HeaderUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Object of header-value pair to update or add.
     *
     * @var array<string,string> $headers
     */
    #[Required(map: 'string')]
    public array $headers;

    /**
     * `new HeaderUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * HeaderUpdateParams::with(headers: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new HeaderUpdateParams)->withHeaders(...)
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
     * @param array<string,string> $headers
     */
    public static function with(array $headers): self
    {
        $self = new self;

        $self['headers'] = $headers;

        return $self;
    }

    /**
     * Object of header-value pair to update or add.
     *
     * @param array<string,string> $headers
     */
    public function withHeaders(array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }
}
