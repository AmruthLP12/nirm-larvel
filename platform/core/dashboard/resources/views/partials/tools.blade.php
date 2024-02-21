<div class="tools">
    @php
        $hiddenIcons = '';
        if (Arr::get($settings, 'show_state', true) && Arr::get($settings, 'state', 'expand') == 'collapse') {
            $hiddenIcons = 'd-none';
        }
    @endphp
    @if (Arr::get($settings, 'show_predefined_ranges', false) && count($predefinedRanges))
        <div class="predefined-ranges d-inline-block {{ $hiddenIcons }}">
            {!! Form::customSelect('predefined_range', collect($predefinedRanges)->pluck('label', 'key')->all(), Arr::get($settings, 'predefined_range'), ['class' => 'py-0']) !!}
        </div>
    @endif
    <a href="#" class="{{ Arr::get($settings, 'state', 'expand') }}" data-toggle="tooltip" title="{{ trans('core/dashboard::dashboard.collapse_expand') }}" data-state="{{ Arr::get($settings, 'state', 'expand') == 'collapse' ? 'expand' : 'collapse' }}"></a>
    <a href="#" class="reload" data-toggle="tooltip" title="{{ trans('core/dashboard::dashboard.reload') }}"></a>
    <a href="#" class="fullscreen" data-toggle="tooltip" data-original-title="{{ trans('core/dashboard::dashboard.fullscreen') }}" title="{{ trans('core/dashboard::dashboard.fullscreen') }}"> </a>
    <a href="#" class="remove" data-toggle="tooltip" title="{{ trans('core/dashboard::dashboard.hide') }}"></a>
</div>