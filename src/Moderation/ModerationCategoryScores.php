<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

use Dodopayments\Core\Attributes\Required;
use Dodopayments\Core\Concerns\SdkModel;
use Dodopayments\Core\Contracts\BaseModel;

/**
 * The probability, from 0 to 1, that the screen falls in each category.
 *
 * @phpstan-type ModerationCategoryScoresShape = array{
 *   childSexualExploitation: float,
 *   defamation: float,
 *   hate: float,
 *   indiscriminateWeapons: float,
 *   intellectualProperty: float,
 *   livingArtistStyle: float,
 *   minorCodedLanguage: float,
 *   nonConsensualIntimateImagery: float,
 *   nonViolentCrimes: float,
 *   privacy: float,
 *   promptInjection: float,
 *   realPersonLikeness: float,
 *   sexRelatedCrimes: float,
 *   sexualContent: float,
 *   specializedAdvice: float,
 *   suicideAndSelfHarm: float,
 *   violentCrimes: float,
 * }
 */
final class ModerationCategoryScores implements BaseModel
{
    /** @use SdkModel<ModerationCategoryScoresShape> */
    use SdkModel;

    /**
     * Child sexual exploitation.
     */
    #[Required('child_sexual_exploitation')]
    public float $childSexualExploitation;

    /**
     * False depiction that is likely to injure the reputation of a real person.
     */
    #[Required]
    public float $defamation;

    /**
     * Demeaning people because of a protected characteristic.
     */
    #[Required]
    public float $hate;

    /**
     * Chemical, biological, radiological, nuclear or explosive weapons.
     */
    #[Required('indiscriminate_weapons')]
    public float $indiscriminateWeapons;

    /**
     * Copyright or trademark infringement.
     */
    #[Required('intellectual_property')]
    public float $intellectualProperty;

    /**
     * Imitation of the signature style of a specific living artist.
     */
    #[Required('living_artist_style')]
    public float $livingArtistStyle;

    /**
     * Age-coded language that suggests the subject is a minor.
     */
    #[Required('minor_coded_language')]
    public float $minorCodedLanguage;

    /**
     * Non-consensual intimate imagery: undressing, nudifying or sexualising a real person.
     */
    #[Required('non_consensual_intimate_imagery')]
    public float $nonConsensualIntimateImagery;

    /**
     * Non-violent crimes.
     */
    #[Required('non_violent_crimes')]
    public float $nonViolentCrimes;

    /**
     * Sensitive private information about a person.
     */
    #[Required]
    public float $privacy;

    /**
     * An attempt to override or manipulate the instructions of the system.
     */
    #[Required('prompt_injection')]
    public float $promptInjection;

    /**
     * The likeness of a real, identifiable, named person.
     */
    #[Required('real_person_likeness')]
    public float $realPersonLikeness;

    /**
     * Sex-related crimes.
     */
    #[Required('sex_related_crimes')]
    public float $sexRelatedCrimes;

    /**
     * Sexually explicit or pornographic content.
     */
    #[Required('sexual_content')]
    public float $sexualContent;

    /**
     * Unqualified financial, medical, legal or electoral advice.
     */
    #[Required('specialized_advice')]
    public float $specializedAdvice;

    /**
     * Suicide and self-harm.
     */
    #[Required('suicide_and_self_harm')]
    public float $suicideAndSelfHarm;

    /**
     * Violent crimes.
     */
    #[Required('violent_crimes')]
    public float $violentCrimes;

    /**
     * `new ModerationCategoryScores()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ModerationCategoryScores::with(
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
     * (new ModerationCategoryScores)
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
     */
    public static function with(
        float $childSexualExploitation,
        float $defamation,
        float $hate,
        float $indiscriminateWeapons,
        float $intellectualProperty,
        float $livingArtistStyle,
        float $minorCodedLanguage,
        float $nonConsensualIntimateImagery,
        float $nonViolentCrimes,
        float $privacy,
        float $promptInjection,
        float $realPersonLikeness,
        float $sexRelatedCrimes,
        float $sexualContent,
        float $specializedAdvice,
        float $suicideAndSelfHarm,
        float $violentCrimes,
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
     */
    public function withChildSexualExploitation(
        float $childSexualExploitation
    ): self {
        $self = clone $this;
        $self['childSexualExploitation'] = $childSexualExploitation;

        return $self;
    }

    /**
     * False depiction that is likely to injure the reputation of a real person.
     */
    public function withDefamation(float $defamation): self
    {
        $self = clone $this;
        $self['defamation'] = $defamation;

        return $self;
    }

    /**
     * Demeaning people because of a protected characteristic.
     */
    public function withHate(float $hate): self
    {
        $self = clone $this;
        $self['hate'] = $hate;

        return $self;
    }

    /**
     * Chemical, biological, radiological, nuclear or explosive weapons.
     */
    public function withIndiscriminateWeapons(
        float $indiscriminateWeapons
    ): self {
        $self = clone $this;
        $self['indiscriminateWeapons'] = $indiscriminateWeapons;

        return $self;
    }

    /**
     * Copyright or trademark infringement.
     */
    public function withIntellectualProperty(float $intellectualProperty): self
    {
        $self = clone $this;
        $self['intellectualProperty'] = $intellectualProperty;

        return $self;
    }

    /**
     * Imitation of the signature style of a specific living artist.
     */
    public function withLivingArtistStyle(float $livingArtistStyle): self
    {
        $self = clone $this;
        $self['livingArtistStyle'] = $livingArtistStyle;

        return $self;
    }

    /**
     * Age-coded language that suggests the subject is a minor.
     */
    public function withMinorCodedLanguage(float $minorCodedLanguage): self
    {
        $self = clone $this;
        $self['minorCodedLanguage'] = $minorCodedLanguage;

        return $self;
    }

    /**
     * Non-consensual intimate imagery: undressing, nudifying or sexualising a real person.
     */
    public function withNonConsensualIntimateImagery(
        float $nonConsensualIntimateImagery
    ): self {
        $self = clone $this;
        $self['nonConsensualIntimateImagery'] = $nonConsensualIntimateImagery;

        return $self;
    }

    /**
     * Non-violent crimes.
     */
    public function withNonViolentCrimes(float $nonViolentCrimes): self
    {
        $self = clone $this;
        $self['nonViolentCrimes'] = $nonViolentCrimes;

        return $self;
    }

    /**
     * Sensitive private information about a person.
     */
    public function withPrivacy(float $privacy): self
    {
        $self = clone $this;
        $self['privacy'] = $privacy;

        return $self;
    }

    /**
     * An attempt to override or manipulate the instructions of the system.
     */
    public function withPromptInjection(float $promptInjection): self
    {
        $self = clone $this;
        $self['promptInjection'] = $promptInjection;

        return $self;
    }

    /**
     * The likeness of a real, identifiable, named person.
     */
    public function withRealPersonLikeness(float $realPersonLikeness): self
    {
        $self = clone $this;
        $self['realPersonLikeness'] = $realPersonLikeness;

        return $self;
    }

    /**
     * Sex-related crimes.
     */
    public function withSexRelatedCrimes(float $sexRelatedCrimes): self
    {
        $self = clone $this;
        $self['sexRelatedCrimes'] = $sexRelatedCrimes;

        return $self;
    }

    /**
     * Sexually explicit or pornographic content.
     */
    public function withSexualContent(float $sexualContent): self
    {
        $self = clone $this;
        $self['sexualContent'] = $sexualContent;

        return $self;
    }

    /**
     * Unqualified financial, medical, legal or electoral advice.
     */
    public function withSpecializedAdvice(float $specializedAdvice): self
    {
        $self = clone $this;
        $self['specializedAdvice'] = $specializedAdvice;

        return $self;
    }

    /**
     * Suicide and self-harm.
     */
    public function withSuicideAndSelfHarm(float $suicideAndSelfHarm): self
    {
        $self = clone $this;
        $self['suicideAndSelfHarm'] = $suicideAndSelfHarm;

        return $self;
    }

    /**
     * Violent crimes.
     */
    public function withViolentCrimes(float $violentCrimes): self
    {
        $self = clone $this;
        $self['violentCrimes'] = $violentCrimes;

        return $self;
    }
}
