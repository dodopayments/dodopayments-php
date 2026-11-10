<?php

declare(strict_types=1);

namespace Dodopayments\Blocklist\Customers\Notes;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * @phpstan-type NoteRequestShape = array{text: string}
 */
final class NoteRequest implements BaseModel
{
    /** @use SdkModel<NoteRequestShape> */
    use SdkModel;

    #[Required]
    public string $text;

    /**
     * `new NoteRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NoteRequest::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NoteRequest)->withText(...)
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
    public static function with(string $text): self
    {
        $self = new self;

        $self['text'] = $text;

        return $self;
    }

    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
