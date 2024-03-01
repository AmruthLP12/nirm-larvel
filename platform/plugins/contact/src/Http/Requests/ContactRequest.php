<?php

namespace Obii\Contact\Http\Requests;

use Obii\Support\Http\Requests\Request;

class ContactRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function rules()
    {
        if (setting('enable_captcha') && is_plugin_active('captcha')) {
            return [
                'name'  => 'required',
                'subject'  => 'required',
                'email'                => 'required|email',
                'phone_number' => 'required',
                'content'              => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ];
        }
        return [
            'name' => 'required',
            'subject' => 'required',
            'phone_number' => 'required',
            'email'   => 'required|email',
            'content' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => trans('plugins/contact::contact.form.name.required'),
            'subject.required'    => trans('plugins/contact::contact.form.subject.required'),
            'phone_number.required'    => trans('plugins/contact::contact.form.phone_number.required'),
            'email.required'   => trans('plugins/contact::contact.form.email.required'),
            'email.email'      => trans('plugins/contact::contact.form.email.email'),
            'content.required' => trans('plugins/contact::contact.form.content.required'),
            'g-recaptcha-response.required' => __('The recaptcha field is required.')
        ];
    }
}
