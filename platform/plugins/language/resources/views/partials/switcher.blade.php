@php
    if (!Language::isLanguageSwitcherEnabled()) {
        return;
    }

    $supportedLocales = Language::getSupportedLocales();
    if (!isset($options) || empty($options)) {
        $options = [
            'before'    => '',
            'lang_flag' => true,
            'lang_name' => true,
            'class'     => '',
            'after'     => '',
        ];
    }
@endphp

@if ($supportedLocales && count($supportedLocales) > 1)
    @php
        $languageDisplay   = setting('language_display', 'all');
        $translationMode   = Language::getTranslationMode();
        $fallbackBehavior  = Language::getManualFallbackBehavior();
        $defaultLocale     = Language::getDefaultLocale();
        $currentLocale     = Language::getCurrentLocale();
        $defaultGoogleCode = \Obii\Language\Services\GoogleTranslateService::getGoogleCode($defaultLocale) ?: 'en';
        $includedGoogleCodes = Language::getGoogleIncludedLanguagesString();
        $publishedTranslations = Language::getPublishedTranslationsForCurrentPage();
    @endphp

    {!! Arr::get($options, 'before') !!}

    @if (setting('language_switcher_display', 'dropdown') == 'dropdown')
        <div class="dropdown language-switcher-wrap notranslate skiptranslate" translate="no" data-translation-mode="{{ $translationMode }}">
            <button class="btn btn-secondary dropdown-toggle language-toggle-btn notranslate skiptranslate" translate="no" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="languageDropdownBtn">
                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                    <span class="current-lang-flag notranslate" translate="no" data-default-flag="{{ language_flag(Language::getCurrentLocaleFlag(), Language::getCurrentLocaleName()) }}">{!! language_flag(Language::getCurrentLocaleFlag(), Language::getCurrentLocaleName()) !!}</span>
                @endif
                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                    <span class="current-lang-name notranslate" translate="no" data-default-name="{{ Language::getCurrentLocaleName() }}">{{ Language::getCurrentLocaleName() }}</span>
                @endif
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu language_bar_chooser notranslate skiptranslate {{ Arr::get($options, 'class') }}" translate="no" aria-labelledby="languageDropdownBtn">
                @foreach ($supportedLocales as $localeCode => $properties)
                    @php
                        $isCurrent = ($localeCode == $currentLocale);
                        $hasPublished = Language::hasPublishedTranslation($localeCode);
                        $publishedUrl = Language::getPublishedTranslationUrl($localeCode) ?: Language::getLocalizedURL($localeCode);
                        $gtCode = Language::getGoogleTranslateCode($properties['lang_code'] ?? $localeCode);
                        $isGtSupported = !empty($gtCode);
                    @endphp

                    {{-- Mode B: CMS-managed Only --}}
                    @if ($translationMode === 'cms')
                        @if (!$hasPublished && $fallbackBehavior === 'hide_language' && !$isCurrent)
                            @continue
                        @endif
                        <li class="{{ $isCurrent ? 'active' : '' }}" data-locale="{{ $localeCode }}">
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $hasPublished ? $publishedUrl : ($fallbackBehavior === 'show_default' ? $publishedUrl : 'javascript:void(0);') }}" class="{{ !$hasPublished ? 'translation-fallback' : '' }}" data-lang-code="{{ $localeCode }}" data-lang-name="{{ $properties['lang_name'] }}">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                @endif
                                @if ($hasPublished)
                                    <span class="gt-badge gt-badge-published" title="{{ trans('plugins/language::language.published_translation') }}">Official</span>
                                @elseif (!$isCurrent)
                                    <span class="gt-badge gt-badge-fallback" title="Default version">Default</span>
                                @endif
                            </a>
                        </li>

                    {{-- Mode A: Google Translate Only --}}
                    @elseif ($translationMode === 'google')
                        @if (!$isGtSupported && !$isCurrent)
                            @continue
                        @endif
                        <li class="{{ $isCurrent ? 'active' : '' }}" data-locale="{{ $localeCode }}" data-gt-code="{{ $gtCode ?: '' }}">
                            <a href="javascript:void(0);" 
                               class="gt-translate-link"
                               data-google-code="{{ $gtCode ?: $defaultGoogleCode }}"
                               data-lang-code="{{ $gtCode ?: $defaultGoogleCode }}"
                               data-lang-name="{{ $properties['lang_name'] }}"
                               onclick="window.triggerGoogleTranslate('{{ $gtCode ?: $defaultGoogleCode }}'); return false;">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        </li>

                    {{-- Mode C: Both Translation Methods --}}
                    @else
                        <li class="{{ $isCurrent ? 'active' : '' }} d-flex align-items-center justify-content-between language-item-dual" data-locale="{{ $localeCode }}" data-gt-code="{{ $gtCode ?: '' }}">
                            @if ($localeCode === $defaultLocale)
                                {{-- Default / Original language --}}
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $publishedUrl }}" class="gt-nav-link flex-grow-1" data-lang-code="{{ $localeCode }}" data-lang-name="{{ $properties['lang_name'] }}" onclick="window.clearGoogleTranslateCookie();">
                                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                        {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                    @endif
                                    @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                        <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                    @endif
                                </a>
                            @elseif ($hasPublished)
                                {{-- Has official CMS-managed translation --}}
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $publishedUrl }}" class="gt-nav-link flex-grow-1" data-lang-code="{{ $localeCode }}" data-lang-name="{{ $properties['lang_name'] }}" onclick="window.clearGoogleTranslateCookie();">
                                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                        {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                    @endif
                                    @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                        <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                    @endif
                                </a>
                            @else
                                {{-- No manual translation for this page --}}
                                @if ($isGtSupported)
                                    <a href="javascript:void(0);" 
                                       class="gt-nav-link flex-grow-1" 
                                       data-lang-code="{{ $gtCode }}"
                                       data-lang-name="{{ $properties['lang_name'] }}"
                                       onclick="window.triggerGoogleTranslate('{{ $gtCode }}'); return false;">
                                        @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                            {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                        @endif
                                        @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                            <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                        @endif
                                    </a>
                                @elseif ($fallbackBehavior !== 'hide_language')
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $publishedUrl }}" class="gt-nav-link flex-grow-1" data-lang-code="{{ $localeCode }}" data-lang-name="{{ $properties['lang_name'] }}">
                                        @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                            {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                        @endif
                                        @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                            <span class="lang-text">{{ $properties['lang_name'] }}</span>
                                        @endif
                                    </a>
                                @endif
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        {{-- List Display --}}
        <ul class="language_bar_list notranslate skiptranslate {{ Arr::get($options, 'class') }}" translate="no" data-translation-mode="{{ $translationMode }}">
            @foreach ($supportedLocales as $localeCode => $properties)
                @php
                    $isCurrent = ($localeCode == $currentLocale);
                    $hasPublished = Language::hasPublishedTranslation($localeCode);
                    $publishedUrl = Language::getPublishedTranslationUrl($localeCode) ?: Language::getLocalizedURL($localeCode);
                    $gtCode = Language::getGoogleTranslateCode($properties['lang_code'] ?? $localeCode);
                    $isGtSupported = !empty($gtCode);
                @endphp
                @if ($translationMode === 'google')
                    <li class="{{ $isCurrent ? 'active' : '' }}">
                        <a href="javascript:void(0);" onclick="window.triggerGoogleTranslate('{{ $gtCode ?: $defaultGoogleCode }}'); return false;">
                            @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                            @endif
                            @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                <span>{{ $properties['lang_name'] }}</span>
                            @endif
                        </a>
                    </li>
                @elseif ($translationMode === 'cms')
                    @if ($hasPublished || $fallbackBehavior !== 'hide_language')
                        <li class="{{ $isCurrent ? 'active' : '' }}">
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $publishedUrl }}">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span>{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                @else
                    {{-- Both mode --}}
                    <li class="{{ $isCurrent ? 'active' : '' }}">
                        @if ($localeCode === $defaultLocale || $hasPublished)
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ $publishedUrl }}" onclick="window.clearGoogleTranslateCookie();">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span>{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        @elseif ($isGtSupported)
                            <a href="javascript:void(0);" onclick="window.triggerGoogleTranslate('{{ $gtCode }}'); return false;">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    <span>{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
        <div class="clearfix"></div>
    @endif

    {!! Arr::get($options, 'after') !!}

    {{-- Google Translate & Dual Mode Support Elements --}}
    @if ($translationMode === 'google' || $translationMode === 'both')
        <div id="google_translate_hidden_container" style="position:absolute; left:-9999px; top:0; width:1px; height:1px; overflow:hidden;">
    <div id="google_translate_element"></div>
</div>

        <div id="gt-config" 
             data-mode="{{ $translationMode }}" 
             data-default-lang="{{ $defaultGoogleCode }}" 
             data-included-langs="{{ $includedGoogleCodes }}"
             data-show-disclaimer="{{ Language::showMachineTranslationLabel() ? '1' : '0' }}"
             data-disclaimer-text="{{ Language::getMachineTranslationLabelText() }}"
             style="display:none !important;"></div>


    @endif
@endif
