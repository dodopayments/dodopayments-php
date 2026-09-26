<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * How each score in `categories` was measured.
 *
 * @phpstan-type ModerationCategoryProvenanceShape = array{
 *   childSexualExploitation: ModerationProvenance|value-of<ModerationProvenance>,
 *   defamation: ModerationProvenance|value-of<ModerationProvenance>,
 *   hate: ModerationProvenance|value-of<ModerationProvenance>,
 *   indiscriminateWeapons: ModerationProvenance|value-of<ModerationProvenance>,
 *   intellectualProperty: ModerationProvenance|value-of<ModerationProvenance>,
 *   livingArtistStyle: ModerationProvenance|value-of<ModerationProvenance>,
 *   minorCodedLanguage: ModerationProvenance|value-of<ModerationProvenance>,
 *   nonConsensualIntimateImagery: ModerationProvenance|value-of<ModerationProvenance>,
 *   nonViolentCrimes: ModerationProvenance|value-of<ModerationProvenance>,
 *   privacy: ModerationProvenance|value-of<ModerationProvenance>,
 *   promptInjection: ModerationProvenance|value-of<ModerationProvenance>,
 *   realPersonLikeness: ModerationProvenance|value-of<ModerationProvenance>,
 *   sexRelatedCrimes: ModerationProvenance|value-of<ModerationProvenance>,
 *   sexualContent: ModerationProvenance|value-of<ModerationProvenance>,
 *   specializedAdvice: ModerationProvenance|value-of<ModerationProvenance>,
 *   suicideAndSelfHarm: ModerationProvenance|value-of<ModerationProvenance>,
 *   violentCrimes: ModerationProvenance|value-of<ModerationProvenance>,
 * }
 */
final class ModerationCategoryProvenance implements BaseModel
{
    /** @use SdkModel<ModerationCategoryProvenanceShape> */
    use SdkModel;

    /**
     * Child sexual exploitation.
     *
     * @var value-of<ModerationProvenance> $childSexualExploitation
     */
    #[Required('child_sexual_exploitation', enum: ModerationProvenance::class)]
    public string $childSexualExploitation;

    /**
     * False depiction that is likely to injure the reputation of a real person.
     *
     * @var value-of<ModerationProvenance> $defamation
     */
    #[Required(enum: ModerationProvenance::class)]
    public string $defamation;

    /**
     * Demeaning people because of a protected characteristic.
     *
     * @var value-of<ModerationProvenance> $hate
     */
    #[Required(enum: ModerationProvenance::class)]
    public string $hate;

    /**
     * Chemical, biological, radiological, nuclear or explosive weapons.
     *
     * @var value-of<ModerationProvenance> $indiscriminateWeapons
     */
    #[Required('indiscriminate_weapons', enum: ModerationProvenance::class)]
    public string $indiscriminateWeapons;

    /**
     * Copyright or trademark infringement.
     *
     * @var value-of<ModerationProvenance> $intellectualProperty
     */
    #[Required('intellectual_property', enum: ModerationProvenance::class)]
    public string $intellectualProperty;

    /**
     * Imitation of the signature style of a specific living artist.
     *
     * @var value-of<ModerationProvenance> $livingArtistStyle
     */
    #[Required('living_artist_style', enum: ModerationProvenance::class)]
    public string $livingArtistStyle;

    /**
     * Age-coded language that suggests the subject is a minor.
     *
     * @var value-of<ModerationProvenance> $minorCodedLanguage
     */
    #[Required('minor_coded_language', enum: ModerationProvenance::class)]
    public string $minorCodedLanguage;

    /**
     * Non-consensual intimate imagery: undressing, nudifying or sexualising a real person.
     *
     * @var value-of<ModerationProvenance> $nonConsensualIntimateImagery
     */
    #[Required(
        'non_consensual_intimate_imagery',
        enum: ModerationProvenance::class
    )]
    public string $nonConsensualIntimateImagery;

    /**
     * Non-violent crimes.
     *
     * @var value-of<ModerationProvenance> $nonViolentCrimes
     */
    #[Required('non_violent_crimes', enum: ModerationProvenance::class)]
    public string $nonViolentCrimes;

    /**
     * Sensitive private information about a person.
     *
     * @var value-of<ModerationProvenance> $privacy
     */
    #[Required(enum: ModerationProvenance::class)]
    public string $privacy;

    /**
     * An attempt to override or manipulate the instructions of the system.
     *
     * @var value-of<ModerationProvenance> $promptInjection
     */
    #[Required('prompt_injection', enum: ModerationProvenance::class)]
    public string $promptInjection;

    /**
     * The likeness of a real, identifiable, named person.
     *
     * @var value-of<ModerationProvenance> $realPersonLikeness
     */
    #[Required('real_person_likeness', enum: ModerationProvenance::class)]
    public string $realPersonLikeness;

    /**
     * Sex-related crimes.
     *
     * @var value-of<ModerationProvenance> $sexRelatedCrimes
     */
    #[Required('sex_related_crimes', enum: ModerationProvenance::class)]
    public string $sexRelatedCrimes;

    /**
     * Sexually explicit or pornographic content.
     *
     * @var value-of<ModerationProvenance> $sexualContent
     */
    #[Required('sexual_content', enum: ModerationProvenance::class)]
    public string $sexualContent;

    /**
     * Unqualified financial, medical, legal or electoral advice.
     *
     * @var value-of<ModerationProvenance> $specializedAdvice
     */
    #[Required('specialized_advice', enum: ModerationProvenance::class)]
    public string $specializedAdvice;

    /**
     * Suicide and self-harm.
     *
     * @var value-of<ModerationProvenance> $suicideAndSelfHarm
     */
    #[Required('suicide_and_self_harm', enum: ModerationProvenance::class)]
    public string $suicideAndSelfHarm;

    /**
     * Violent crimes.
     *
     * @var value-of<ModerationProvenance> $violentCrimes
     */
    #[Required('violent_crimes', enum: ModerationProvenance::class)]
    public string $violentCrimes;

    /**
     * `new ModerationCategoryProvenance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModerationCategoryProvenance::with(
     *   childSexualExploitation: ...,
     *   defamation: ...,
     *   hate: ...,
     *   indiscriminateWeapons: ...,
     *   intellectualProperty: ...,
     *   livingArtistStyle: ...,
     *   minorCodedLanguage: ...,
     *   nonConsensualIntimateImagery: ...,
     *   nonViolentCrimes: ...,
     *   privacy: ...,
     *   promptInjection: ...,
     *   realPersonLikeness: ...,
     *   sexRelatedCrimes: ...,
     *   sexualContent: ...,
     *   specializedAdvice: ...,
     *   suicideAndSelfHarm: ...,
     *   violentCrimes: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ModerationCategoryProvenance)
     *   ->withChildSexualExploitation(...)
     *   ->withDefamation(...)
     *   ->withHate(...)
     *   ->withIndiscriminateWeapons(...)
     *   ->withIntellectualProperty(...)
     *   ->withLivingArtistStyle(...)
     *   ->withMinorCodedLanguage(...)
     *   ->withNonConsensualIntimateImagery(...)
     *   ->withNonViolentCrimes(...)
     *   ->withPrivacy(...)
     *   ->withPromptInjection(...)
     *   ->withRealPersonLikeness(...)
     *   ->withSexRelatedCrimes(...)
     *   ->withSexualContent(...)
     *   ->withSpecializedAdvice(...)
     *   ->withSuicideAndSelfHarm(...)
     *   ->withViolentCrimes(...)
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
     * @param ModerationProvenance|value-of<ModerationProvenance> $childSexualExploitation
     * @param ModerationProvenance|value-of<ModerationProvenance> $defamation
     * @param ModerationProvenance|value-of<ModerationProvenance> $hate
     * @param ModerationProvenance|value-of<ModerationProvenance> $indiscriminateWeapons
     * @param ModerationProvenance|value-of<ModerationProvenance> $intellectualProperty
     * @param ModerationProvenance|value-of<ModerationProvenance> $livingArtistStyle
     * @param ModerationProvenance|value-of<ModerationProvenance> $minorCodedLanguage
     * @param ModerationProvenance|value-of<ModerationProvenance> $nonConsensualIntimateImagery
     * @param ModerationProvenance|value-of<ModerationProvenance> $nonViolentCrimes
     * @param ModerationProvenance|value-of<ModerationProvenance> $privacy
     * @param ModerationProvenance|value-of<ModerationProvenance> $promptInjection
     * @param ModerationProvenance|value-of<ModerationProvenance> $realPersonLikeness
     * @param ModerationProvenance|value-of<ModerationProvenance> $sexRelatedCrimes
     * @param ModerationProvenance|value-of<ModerationProvenance> $sexualContent
     * @param ModerationProvenance|value-of<ModerationProvenance> $specializedAdvice
     * @param ModerationProvenance|value-of<ModerationProvenance> $suicideAndSelfHarm
     * @param ModerationProvenance|value-of<ModerationProvenance> $violentCrimes
     */
    public static function with(
        ModerationProvenance|string $childSexualExploitation,
        ModerationProvenance|string $defamation,
        ModerationProvenance|string $hate,
        ModerationProvenance|string $indiscriminateWeapons,
        ModerationProvenance|string $intellectualProperty,
        ModerationProvenance|string $livingArtistStyle,
        ModerationProvenance|string $minorCodedLanguage,
        ModerationProvenance|string $nonConsensualIntimateImagery,
        ModerationProvenance|string $nonViolentCrimes,
        ModerationProvenance|string $privacy,
        ModerationProvenance|string $promptInjection,
        ModerationProvenance|string $realPersonLikeness,
        ModerationProvenance|string $sexRelatedCrimes,
        ModerationProvenance|string $sexualContent,
        ModerationProvenance|string $specializedAdvice,
        ModerationProvenance|string $suicideAndSelfHarm,
        ModerationProvenance|string $violentCrimes,
    ): self {
        $self = new self;

        $self['childSexualExploitation'] = $childSexualExploitation;
        $self['defamation'] = $defamation;
        $self['hate'] = $hate;
        $self['indiscriminateWeapons'] = $indiscriminateWeapons;
        $self['intellectualProperty'] = $intellectualProperty;
        $self['livingArtistStyle'] = $livingArtistStyle;
        $self['minorCodedLanguage'] = $minorCodedLanguage;
        $self['nonConsensualIntimateImagery'] = $nonConsensualIntimateImagery;
        $self['nonViolentCrimes'] = $nonViolentCrimes;
        $self['privacy'] = $privacy;
        $self['promptInjection'] = $promptInjection;
        $self['realPersonLikeness'] = $realPersonLikeness;
        $self['sexRelatedCrimes'] = $sexRelatedCrimes;
        $self['sexualContent'] = $sexualContent;
        $self['specializedAdvice'] = $specializedAdvice;
        $self['suicideAndSelfHarm'] = $suicideAndSelfHarm;
        $self['violentCrimes'] = $violentCrimes;

        return $self;
    }

    /**
     * Child sexual exploitation.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $childSexualExploitation
     */
    public function withChildSexualExploitation(
        ModerationProvenance|string $childSexualExploitation
    ): self {
        $self = clone $this;
        $self['childSexualExploitation'] = $childSexualExploitation;

        return $self;
    }

    /**
     * False depiction that is likely to injure the reputation of a real person.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $defamation
     */
    public function withDefamation(
        ModerationProvenance|string $defamation
    ): self {
        $self = clone $this;
        $self['defamation'] = $defamation;

        return $self;
    }

    /**
     * Demeaning people because of a protected characteristic.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $hate
     */
    public function withHate(ModerationProvenance|string $hate): self
    {
        $self = clone $this;
        $self['hate'] = $hate;

        return $self;
    }

    /**
     * Chemical, biological, radiological, nuclear or explosive weapons.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $indiscriminateWeapons
     */
    public function withIndiscriminateWeapons(
        ModerationProvenance|string $indiscriminateWeapons
    ): self {
        $self = clone $this;
        $self['indiscriminateWeapons'] = $indiscriminateWeapons;

        return $self;
    }

    /**
     * Copyright or trademark infringement.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $intellectualProperty
     */
    public function withIntellectualProperty(
        ModerationProvenance|string $intellectualProperty
    ): self {
        $self = clone $this;
        $self['intellectualProperty'] = $intellectualProperty;

        return $self;
    }

    /**
     * Imitation of the signature style of a specific living artist.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $livingArtistStyle
     */
    public function withLivingArtistStyle(
        ModerationProvenance|string $livingArtistStyle
    ): self {
        $self = clone $this;
        $self['livingArtistStyle'] = $livingArtistStyle;

        return $self;
    }

    /**
     * Age-coded language that suggests the subject is a minor.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $minorCodedLanguage
     */
    public function withMinorCodedLanguage(
        ModerationProvenance|string $minorCodedLanguage
    ): self {
        $self = clone $this;
        $self['minorCodedLanguage'] = $minorCodedLanguage;

        return $self;
    }

    /**
     * Non-consensual intimate imagery: undressing, nudifying or sexualising a real person.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $nonConsensualIntimateImagery
     */
    public function withNonConsensualIntimateImagery(
        ModerationProvenance|string $nonConsensualIntimateImagery
    ): self {
        $self = clone $this;
        $self['nonConsensualIntimateImagery'] = $nonConsensualIntimateImagery;

        return $self;
    }

    /**
     * Non-violent crimes.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $nonViolentCrimes
     */
    public function withNonViolentCrimes(
        ModerationProvenance|string $nonViolentCrimes
    ): self {
        $self = clone $this;
        $self['nonViolentCrimes'] = $nonViolentCrimes;

        return $self;
    }

    /**
     * Sensitive private information about a person.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $privacy
     */
    public function withPrivacy(ModerationProvenance|string $privacy): self
    {
        $self = clone $this;
        $self['privacy'] = $privacy;

        return $self;
    }

    /**
     * An attempt to override or manipulate the instructions of the system.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $promptInjection
     */
    public function withPromptInjection(
        ModerationProvenance|string $promptInjection
    ): self {
        $self = clone $this;
        $self['promptInjection'] = $promptInjection;

        return $self;
    }

    /**
     * The likeness of a real, identifiable, named person.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $realPersonLikeness
     */
    public function withRealPersonLikeness(
        ModerationProvenance|string $realPersonLikeness
    ): self {
        $self = clone $this;
        $self['realPersonLikeness'] = $realPersonLikeness;

        return $self;
    }

    /**
     * Sex-related crimes.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $sexRelatedCrimes
     */
    public function withSexRelatedCrimes(
        ModerationProvenance|string $sexRelatedCrimes
    ): self {
        $self = clone $this;
        $self['sexRelatedCrimes'] = $sexRelatedCrimes;

        return $self;
    }

    /**
     * Sexually explicit or pornographic content.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $sexualContent
     */
    public function withSexualContent(
        ModerationProvenance|string $sexualContent
    ): self {
        $self = clone $this;
        $self['sexualContent'] = $sexualContent;

        return $self;
    }

    /**
     * Unqualified financial, medical, legal or electoral advice.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $specializedAdvice
     */
    public function withSpecializedAdvice(
        ModerationProvenance|string $specializedAdvice
    ): self {
        $self = clone $this;
        $self['specializedAdvice'] = $specializedAdvice;

        return $self;
    }

    /**
     * Suicide and self-harm.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $suicideAndSelfHarm
     */
    public function withSuicideAndSelfHarm(
        ModerationProvenance|string $suicideAndSelfHarm
    ): self {
        $self = clone $this;
        $self['suicideAndSelfHarm'] = $suicideAndSelfHarm;

        return $self;
    }

    /**
     * Violent crimes.
     *
     * @param ModerationProvenance|value-of<ModerationProvenance> $violentCrimes
     */
    public function withViolentCrimes(
        ModerationProvenance|string $violentCrimes
    ): self {
        $self = clone $this;
        $self['violentCrimes'] = $violentCrimes;

        return $self;
    }
}
