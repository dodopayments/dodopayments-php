<?php

declare(strict_types=1);

namespace Dodopayments\Moderation;

/**
 * A moderation category.
 */
enum ModerationCategory: string
{
    case VIOLENT_CRIMES = 'violent_crimes';

    case SEX_RELATED_CRIMES = 'sex_related_crimes';

    case CHILD_SEXUAL_EXPLOITATION = 'child_sexual_exploitation';

    case SUICIDE_AND_SELF_HARM = 'suicide_and_self_harm';

    case INDISCRIMINATE_WEAPONS = 'indiscriminate_weapons';

    case INTELLECTUAL_PROPERTY = 'intellectual_property';

    case DEFAMATION = 'defamation';

    case NON_VIOLENT_CRIMES = 'non_violent_crimes';

    case HATE = 'hate';

    case PRIVACY = 'privacy';

    case SPECIALIZED_ADVICE = 'specialized_advice';

    case SEXUAL_CONTENT = 'sexual_content';

    case NON_CONSENSUAL_INTIMATE_IMAGERY = 'non_consensual_intimate_imagery';

    case MINOR_CODED_LANGUAGE = 'minor_coded_language';

    case REAL_PERSON_LIKENESS = 'real_person_likeness';

    case LIVING_ARTIST_STYLE = 'living_artist_style';

    case PROMPT_INJECTION = 'prompt_injection';
}
