<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The verdict of one screen.
 *
 * @phpstan-import-type ModerationCategoryScoresShape from \Dodopayments\Moderation\ModerationCategoryScores
 * @phpstan-import-type ModerationCategoryProvenanceShape from \Dodopayments\Moderation\ModerationCategoryProvenance
 *
 * @phpstan-type ModerationScreenResponseShape = array{
 *   categories: ModerationCategoryScores|ModerationCategoryScoresShape,
 *   compoundTriggered: bool,
 *   decision: ModerationDecision|value-of<ModerationDecision>,
 *   latencyMs: int,
 *   normalizedApplied: bool,
 *   notes: list<string>,
 *   passes: int,
 *   provenance: ModerationCategoryProvenance|ModerationCategoryProvenanceShape,
 *   requestID: string|null,
 *   triggered: list<ModerationCategory|value-of<ModerationCategory>>,
 * }
 */
final class ModerationScreenResponse implements BaseModel
{
    /** @use SdkModel<ModerationScreenResponseShape> */
    use SdkModel;

    /**
     * The probability, from 0 to 1, that the screen falls in each category.
     */
    #[Required]
    public ModerationCategoryScores $categories;

    /**
     * True when real-person likeness and sexual content together crossed their combined
     * threshold, the pattern of a sexual deepfake.
     */
    #[Required('compound_triggered')]
    public bool $compoundTriggered;

    /**
     * The verdict. `allow` means the content passed. `deny` means block the content. `flag` means
     * apply your own judgement. It is not a soft deny.
     *
     * @var value-of<ModerationDecision> $decision
     */
    #[Required(enum: ModerationDecision::class)]
    public string $decision;

    /**
     * The time the screen took, in milliseconds.
     */
    #[Required('latency_ms')]
    public int $latencyMs;

    /**
     * True when the text was also screened in a normalized form, with obfuscation such as
     * invisible or look-alike characters removed.
     */
    #[Required('normalized_applied')]
    public bool $normalizedApplied;

    /**
     * Human-readable reasons for the decision. The wording can change, so do not parse it.
     *
     * @var list<string> $notes
     */
    #[Required(list: 'string')]
    public array $notes;

    /**
     * The number of yes/no questions the model answered for this screen.
     */
    #[Required]
    public int $passes;

    /**
     * How each score in `categories` was measured.
     */
    #[Required]
    public ModerationCategoryProvenance $provenance;

    /**
     * The `request_id` you sent, or null.
     */
    #[Required('request_id')]
    public ?string $requestID;

    /**
     * The categories whose score crossed the threshold of the category. It can be empty on a
     * `flag` from the general check. `notes` then gives the reason.
     *
     * @var list<value-of<ModerationCategory>> $triggered
     */
    #[Required(list: ModerationCategory::class)]
    public array $triggered;

    /**
     * `new ModerationScreenResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModerationScreenResponse::with(
     *   categories: ...,
     *   compoundTriggered: ...,
     *   decision: ...,
     *   latencyMs: ...,
     *   normalizedApplied: ...,
     *   notes: ...,
     *   passes: ...,
     *   provenance: ...,
     *   requestID: ...,
     *   triggered: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModerationScreenResponse)
     *   ->withCategories(...)
     *   ->withCompoundTriggered(...)
     *   ->withDecision(...)
     *   ->withLatencyMs(...)
     *   ->withNormalizedApplied(...)
     *   ->withNotes(...)
     *   ->withPasses(...)
     *   ->withProvenance(...)
     *   ->withRequestID(...)
     *   ->withTriggered(...)
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
     * @param ModerationCategoryScores|ModerationCategoryScoresShape $categories
     * @param ModerationDecision|value-of<ModerationDecision> $decision
     * @param list<string> $notes
     * @param ModerationCategoryProvenance|ModerationCategoryProvenanceShape $provenance
     * @param list<ModerationCategory|value-of<ModerationCategory>> $triggered
     */
    public static function with(
        ModerationCategoryScores|array $categories,
        bool $compoundTriggered,
        ModerationDecision|string $decision,
        int $latencyMs,
        bool $normalizedApplied,
        array $notes,
        int $passes,
        ModerationCategoryProvenance|array $provenance,
        ?string $requestID,
        array $triggered,
    ): self {
        $self = new self;

        $self['categories'] = $categories;
        $self['compoundTriggered'] = $compoundTriggered;
        $self['decision'] = $decision;
        $self['latencyMs'] = $latencyMs;
        $self['normalizedApplied'] = $normalizedApplied;
        $self['notes'] = $notes;
        $self['passes'] = $passes;
        $self['provenance'] = $provenance;
        $self['requestID'] = $requestID;
        $self['triggered'] = $triggered;

        return $self;
    }

    /**
     * The probability, from 0 to 1, that the screen falls in each category.
     *
     * @param ModerationCategoryScores|ModerationCategoryScoresShape $categories
     */
    public function withCategories(
        ModerationCategoryScores|array $categories
    ): self {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * True when real-person likeness and sexual content together crossed their combined
     * threshold, the pattern of a sexual deepfake.
     */
    public function withCompoundTriggered(bool $compoundTriggered): self
    {
        $self = clone $this;
        $self['compoundTriggered'] = $compoundTriggered;

        return $self;
    }

    /**
     * The verdict. `allow` means the content passed. `deny` means block the content. `flag` means
     * apply your own judgement. It is not a soft deny.
     *
     * @param ModerationDecision|value-of<ModerationDecision> $decision
     */
    public function withDecision(ModerationDecision|string $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }

    /**
     * The time the screen took, in milliseconds.
     */
    public function withLatencyMs(int $latencyMs): self
    {
        $self = clone $this;
        $self['latencyMs'] = $latencyMs;

        return $self;
    }

    /**
     * True when the text was also screened in a normalized form, with obfuscation such as
     * invisible or look-alike characters removed.
     */
    public function withNormalizedApplied(bool $normalizedApplied): self
    {
        $self = clone $this;
        $self['normalizedApplied'] = $normalizedApplied;

        return $self;
    }

    /**
     * Human-readable reasons for the decision. The wording can change, so do not parse it.
     *
     * @param list<string> $notes
     */
    public function withNotes(array $notes): self
    {
        $self = clone $this;
        $self['notes'] = $notes;

        return $self;
    }

    /**
     * The number of yes/no questions the model answered for this screen.
     */
    public function withPasses(int $passes): self
    {
        $self = clone $this;
        $self['passes'] = $passes;

        return $self;
    }

    /**
     * How each score in `categories` was measured.
     *
     * @param ModerationCategoryProvenance|ModerationCategoryProvenanceShape $provenance
     */
    public function withProvenance(
        ModerationCategoryProvenance|array $provenance
    ): self {
        $self = clone $this;
        $self['provenance'] = $provenance;

        return $self;
    }

    /**
     * The `request_id` you sent, or null.
     */
    public function withRequestID(?string $requestID): self
    {
        $self = clone $this;
        $self['requestID'] = $requestID;

        return $self;
    }

    /**
     * The categories whose score crossed the threshold of the category. It can be empty on a
     * `flag` from the general check. `notes` then gives the reason.
     *
     * @param list<ModerationCategory|value-of<ModerationCategory>> $triggered
     */
    public function withTriggered(array $triggered): self
    {
        $self = clone $this;
        $self['triggered'] = $triggered;

        return $self;
    }
}
