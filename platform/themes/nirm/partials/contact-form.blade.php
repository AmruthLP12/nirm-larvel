<style>
    .required::after {
        content: " *";
        color: red;
    }
    button[type="submit"] {
        background-color: #10399d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    button[type="submit"]:hover {
        background-color: #3d5eb3;
        color: #fff;
    }
    input[type="text"], input[type="email"], textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc!important;
        border-radius: 5px;
        margin-bottom: 10px;
        transition: 0.3s;
    }
    textarea{
        height: 150px!important;
    }
    label {
        font-size: 16px;
        font-weight: 600;
    }
    input::placeholder, textarea::placeholder {
        color: #ccc;
        font-size: 14px;
    }
</style>

{!! Form::open(['route' => 'public.send.contact', 'method' => 'POST']) !!}
@if(session()->has('success_msg') || session()->has('error_msg') || isset($errors))
    @if (session()->has('success_msg'))
        <div class="alert alert-success">
            <p>{{ session('success_msg') }}</p>
        </div>
    @endif
    @if (session()->has('error_msg'))
        <div class="alert alert-danger">
            <p>{{ session('error_msg') }}</p>
        </div>
    @endif
    @if (isset($errors) && count($errors))
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span> <br>
            @endforeach
        </div>
    @endif
@endif
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="contact_name" class="control-label required">{{ trans('plugins/contact::contact.form_name') }}</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="contact_name"
                   placeholder="{{ trans('plugins/contact::contact.form_name') }}" required>
        </div>
        <div class="form-group">
            <label for="contact_email" class="control-label required">{{ trans('plugins/contact::contact.form_email') }}</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="contact_email"
                   placeholder="{{ trans('plugins/contact::contact.form_email') }}" required>
        </div>
        <div class="form-group">
            <label for="contact_phone" class="control-label">{{ trans('plugins/contact::contact.form_phone') }}</label>
            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" id="contact_phone"
                   placeholder="{{ trans('plugins/contact::contact.form_phone') }}">
        </div>
        <div class="form-group">
            <label for="contact_subject" class="control-label required">{{ trans('plugins/contact::contact.form_subject') }}</label>
            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" id="contact_subject"
                   placeholder="{{ trans('plugins/contact::contact.form_subject') }}">
        </div>
        <div class="form-group">
            <label for="contact_content" class="control-label required">{{ trans('plugins/contact::contact.form_message') }}</label>
            <textarea name="content" id="contact_content" class="form-control" rows="5" placeholder="{{ trans('plugins/contact::contact.form_message') }}" required>{{ old('content') }}</textarea>
        </div>
    </div>
    @if (setting('enable_captcha') && is_plugin_active('captcha'))
        <div class="col-md-12">
            <div class="form-group">
                <label for="contact_robot" class="control-label required">{{ trans('plugins/contact::contact.confirm_not_robot') }}</label>
                {!! Captcha::display('captcha') !!}
                {!! Captcha::script() !!}
            </div>
        </div>
    @endif
</div>

<div class="form-group"><p>{!! trans('plugins/contact::contact.required_field') !!}</p></div>
<div class="form-group">
    <button type="submit" class="btn btn-primary cyan text">{{ trans('plugins/contact::contact.send_btn') }}</button>
</div>

{!! Form::close() !!}