<?php

namespace Obii\Language\Services;

use Obii\Language\Models\Language;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GoogleTranslateService
{
    /**
     * Complete dictionary of languages supported by Google Translate
     * (ISO 639-1 and regional codes accepted by Google Translate element/API).
     *
     * @var array<string, string>
     */
    protected static $supportedLanguages = [
        'af'      => 'Afrikaans',
        'sq'      => 'Albanian',
        'am'      => 'Amharic',
        'ar'      => 'Arabic',
        'hy'      => 'Armenian',
        'as'      => 'Assamese',
        'ay'      => 'Aymara',
        'az'      => 'Azerbaijani',
        'bm'      => 'Bambara',
        'eu'      => 'Basque',
        'be'      => 'Belarusian',
        'bn'      => 'Bengali',
        'bho'     => 'Bhojpuri',
        'bs'      => 'Bosnian',
        'bg'      => 'Bulgarian',
        'ca'      => 'Catalan',
        'ceb'     => 'Cebuano',
        'ny'      => 'Chichewa',
        'zh-CN'   => 'Chinese (Simplified)',
        'zh-TW'   => 'Chinese (Traditional)',
        'co'      => 'Corsican',
        'hr'      => 'Croatian',
        'cs'      => 'Czech',
        'da'      => 'Danish',
        'dv'      => 'Dhivehi',
        'doi'     => 'Dogri',
        'nl'      => 'Dutch',
        'en'      => 'English',
        'eo'      => 'Esperanto',
        'et'      => 'Estonian',
        'ee'      => 'Ewe',
        'tl'      => 'Filipino (Tagalog)',
        'fi'      => 'Finnish',
        'fr'      => 'French',
        'fy'      => 'Frisian',
        'gl'      => 'Galician',
        'ka'      => 'Georgian',
        'de'      => 'German',
        'el'      => 'Greek',
        'gn'      => 'Guarani',
        'gu'      => 'Gujarati',
        'ht'      => 'Haitian Creole',
        'ha'      => 'Hausa',
        'haw'     => 'Hawaiian',
        'iw'      => 'Hebrew',
        'hi'      => 'Hindi',
        'hmn'     => 'Hmong',
        'hu'      => 'Hungarian',
        'is'      => 'Icelandic',
        'ig'      => 'Igbo',
        'ilo'     => 'Ilocano',
        'id'      => 'Indonesian',
        'ga'      => 'Irish',
        'it'      => 'Italian',
        'ja'      => 'Japanese',
        'jw'      => 'Javanese',
        'kn'      => 'Kannada',
        'kk'      => 'Kazakh',
        'km'      => 'Khmer',
        'rw'      => 'Kinyarwanda',
        'gom'     => 'Konkani',
        'ko'      => 'Korean',
        'kri'     => 'Krio',
        'ku'      => 'Kurdish (Kurmanji)',
        'ckb'     => 'Kurdish (Sorani)',
        'ky'      => 'Kyrgyz',
        'lo'      => 'Lao',
        'la'      => 'Latin',
        'lv'      => 'Latvian',
        'ln'      => 'Lingala',
        'lt'      => 'Lithuanian',
        'lg'      => 'Luganda',
        'lb'      => 'Luxembourgish',
        'mk'      => 'Macedonian',
        'mai'     => 'Maithili',
        'mg'      => 'Malagasy',
        'ms'      => 'Malay',
        'ml'      => 'Malayalam',
        'mt'      => 'Maltese',
        'mi'      => 'Maori',
        'mr'      => 'Marathi',
        'mni-Mtei' => 'Meiteilon (Manipuri)',
        'lus'     => 'Mizo',
        'mn'      => 'Mongolian',
        'my'      => 'Myanmar (Burmese)',
        'ne'      => 'Nepali',
        'no'      => 'Norwegian',
        'or'      => 'Odia (Oriya)',
        'om'      => 'Oromo',
        'ps'      => 'Pashto',
        'fa'      => 'Persian',
        'pl'      => 'Polish',
        'pt'      => 'Portuguese',
        'pa'      => 'Punjabi',
        'qu'      => 'Quechua',
        'ro'      => 'Romanian',
        'ru'      => 'Russian',
        'sm'      => 'Samoan',
        'sa'      => 'Sanskrit',
        'gd'      => 'Scots Gaelic',
        'nso'     => 'Sepedi',
        'sr'      => 'Serbian',
        'st'      => 'Sesotho',
        'sn'      => 'Shona',
        'sd'      => 'Sindhi',
        'si'      => 'Sinhala',
        'sk'      => 'Slovak',
        'sl'      => 'Slovenian',
        'so'      => 'Somali',
        'es'      => 'Spanish',
        'su'      => 'Sundanese',
        'sw'      => 'Swahili',
        'sv'      => 'Swedish',
        'tg'      => 'Tajik',
        'ta'      => 'Tamil',
        'tt'      => 'Tatar',
        'te'      => 'Telugu',
        'th'      => 'Thai',
        'ti'      => 'Tigrinya',
        'ts'      => 'Tsonga',
        'tr'      => 'Turkish',
        'tk'      => 'Turkmen',
        'ak'      => 'Twi',
        'uk'      => 'Ukrainian',
        'ur'      => 'Urdu',
        'ug'      => 'Uyghur',
        'uz'      => 'Uzbek',
        'vi'      => 'Vietnamese',
        'cy'      => 'Welsh',
        'xh'      => 'Xhosa',
        'yi'      => 'Yiddish',
        'yo'      => 'Yoruba',
        'zu'      => 'Zulu',
    ];

    /**
     * Special mappings for regional codes, deprecated codes, or aliases to Google Translate codes.
     *
     * @var array<string, string>
     */
    protected static $codeAliases = [
        'zh_cn'    => 'zh-CN',
        'zh-cn'    => 'zh-CN',
        'zh_hans'  => 'zh-CN',
        'zh-hans'  => 'zh-CN',
        'zh'       => 'zh-CN',
        'zh_tw'    => 'zh-TW',
        'zh-tw'    => 'zh-TW',
        'zh_hant'  => 'zh-TW',
        'zh-hant'  => 'zh-TW',
        'he'       => 'iw',
        'he_il'    => 'iw',
        'fil'      => 'tl',
        'fil_ph'   => 'tl',
        'jv'       => 'jw',
        'jv_id'    => 'jw',
        'nb'       => 'no',
        'nn'       => 'no',
    ];

    /**
     * Get all supported Google Translate languages.
     *
     * @return array<string, string>
     */
    public static function getSupportedLanguages(): array
    {
        return static::$supportedLanguages;
    }

    /**
     * Map any CMS locale or language code to a valid Google Translate code.
     *
     * @param string|null $code
     * @param string|null $locale
     * @return string|null
     */
    public static function toGoogleCode(?string $code, ?string $locale = null): ?string
    {
        $candidates = [];

        if (!empty($locale)) {
            $candidates[] = trim($locale);
        }

        if (!empty($code)) {
            $candidates[] = trim($code);
        }

        foreach ($candidates as $cand) {
            $lower = strtolower($cand);
            $normalizedHyphen = str_replace('_', '-', $cand);

            // 1. Check alias dictionary
            if (isset(static::$codeAliases[$lower])) {
                return static::$codeAliases[$lower];
            }

            // 2. Direct match in supported languages (case-insensitive search)
            foreach (static::$supportedLanguages as $gtCode => $name) {
                if (strcasecmp($gtCode, $cand) === 0 || strcasecmp($gtCode, $normalizedHyphen) === 0) {
                    return $gtCode;
                }
            }

            // 3. Extract primary language subtag (e.g., 'en_US' -> 'en', 'hi_IN' -> 'hi', 'kn_IN' -> 'kn')
            $parts = preg_split('/[_-]/', $cand);
            if (!empty($parts[0])) {
                $primary = strtolower($parts[0]);
                if (isset(static::$codeAliases[$primary])) {
                    return static::$codeAliases[$primary];
                }
                foreach (static::$supportedLanguages as $gtCode => $name) {
                    if (strcasecmp($gtCode, $primary) === 0) {
                        return $gtCode;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Check if a CMS Language record or locale is supported by Google Translate.
     *
     * @param mixed $language Language model, language array, or string code/locale
     * @return bool
     */
    public static function isSupported($language): bool
    {
        return static::getGoogleCode($language) !== null;
    }

    /**
     * Get the Google Translate code for a CMS Language instance or code.
     *
     * @param mixed $language Language model, language array, or string code/locale
     * @return string|null
     */
    public static function getGoogleCode($language): ?string
    {
        if ($language instanceof Language) {
            return static::toGoogleCode($language->lang_code, $language->lang_locale);
        }

        if (is_array($language)) {
            $code = $language['lang_code'] ?? ($language['code'] ?? null);
            $locale = $language['lang_locale'] ?? ($language['locale'] ?? null);
            return static::toGoogleCode($code, $locale);
        }

        if (is_string($language)) {
            return static::toGoogleCode($language);
        }

        return null;
    }

    /**
     * Get list of Google Translate codes for configured active CMS languages,
     * filtering out unsupported or admin-disabled languages.
     *
     * @param iterable $cmsLanguages
     * @return array<string>
     */
    public static function getIncludedLanguages($cmsLanguages): array
    {
        $disabledLanguageIds = json_decode(setting('google_translate_disabled_languages', '[]'), true) ?: [];
        $hiddenLanguages = json_decode(setting('language_hide_languages', '[]'), true) ?: [];

        $included = [];

        foreach ($cmsLanguages as $language) {
            $langId = $language instanceof Language ? $language->lang_id : ($language['lang_id'] ?? null);

            // Skip hidden or disabled languages
            if ($langId && (in_array($langId, $disabledLanguageIds) || in_array($langId, $hiddenLanguages))) {
                continue;
            }

            $googleCode = static::getGoogleCode($language);
            if ($googleCode && !in_array($googleCode, $included)) {
                $included[] = $googleCode;
            }
        }

        return $included;
    }

    /**
     * Get comma-separated string of included languages for Google Translate element initialization.
     *
     * @param iterable $cmsLanguages
     * @return string
     */
    public static function getIncludedLanguagesString($cmsLanguages): string
    {
        $included = static::getIncludedLanguages($cmsLanguages);
        return implode(',', $included);
    }
}
