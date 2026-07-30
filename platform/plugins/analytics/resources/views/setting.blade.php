<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>{{ trans('plugins/analytics::analytics.settings.title') }}</h2>
        </div>
        <div class="annotated-section-description pd-all-20 p-none-t">
            <p class="color-note">{{ trans('plugins/analytics::analytics.settings.description') }}</p>
        </div>
    </div>

    <div class="flexbox-annotated-section-content">
        <div class="wrapper-content pd-all-20">
            <div class="form-group">
                <label class="text-title-field"
                       for="google_analytics">Google Tag ID</label>
                <input data-counter="120" type="text" class="next-input" name="google_analytics" id="google_analytics"
                       value="{{ setting('google_analytics') }}" placeholder="Example: G-">
            </div>
            <div class="form-group">
                <label class="text-title-field"
                       for="analytics_property_id">Property ID For GA4</label>
                <input data-counter="120" type="text" class="next-input" name="analytics_property_id" id="analytics_property_id"
                       value="{{ setting('analytics_property_id', config('plugins.analytics.general.view_id')) }}" placeholder="Google Analytics Property ID (GA4)">
            </div>
            @if (!app()->environment('demo'))
                <div class="form-group">
                    <label class="text-title-field"
                           for="analytics_service_account_credentials">{{ trans('plugins/analytics::analytics.settings.json_credential') }}</label>
                    <textarea class="next-input form-control" name="analytics_service_account_credentials" id="analytics_service_account_credentials" rows="5" placeholder="{{ trans('plugins/analytics::analytics.settings.json_credential_description') }}">{{ setting('analytics_service_account_credentials') }}</textarea>
                </div>
            @endif
        </div>
    </div>
</div>