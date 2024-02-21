<div class="form-group">
    <label class="control-label">Select Category</label>
    {!! Form::customSelect('id', $categories, Arr::get($attributes, 'id')) !!}
</div>
<div class="form-group">
    <label class="control-label">Title</label>
    {!! Form::input('text', 'title', Arr::get($attributes, 'title'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label class="control-label">{{ trans('plugins/blog::base.number_posts_per_page') }}</label>
    {!! Form::number('paginate', theme_option('number_of_posts_in_a_category', 12), ['class' => 'form-control', 'placeholder' => trans('plugins/blog::base.number_posts_per_page')]) !!}
</div>
