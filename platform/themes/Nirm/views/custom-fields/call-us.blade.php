@if (has_field($page, 'call_with_us_description'))
<section class="services-leg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                {!! get_field($page, 'call_with_us_description') !!}
            </div>
            <div class="col-lg-4">
                {!! get_field($page, 'call_with_us_form') !!}
            </div>
        </div>
    </div>
</section>
@endif