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
                'name'  => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:191',
                'subject'  => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:120',
                'email'                => 'required|email:rfc,dns|max:60',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
                'content'              => 'required|min:10|max:5000',
                'g-recaptcha-response' => 'required|captcha',
            ];
        }
        return [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:191',
            'subject' => 'required|regex:/^[\pL\s\-]+$/u|min:3|max:120',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20',
            'email'   => 'required|email:rfc,dns|max:60',
            'content' => 'required|min:10|max:5000',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => trans('plugins/contact::contact.form.name.required'),
            'name.regex' => __('The name field must contain only letters and spaces.'),
            'name.min' => __('The name field must be at least 3 characters.'),
            'name.max' => __('The name field may not be greater than 191 characters.'),
            'subject.required'    => trans('plugins/contact::contact.form.subject.required'),
            'subject.regex' => __('The subject field must contain only letters and spaces.'),
            'subject.min' => __('The subject field must be at least 3 characters.'),
            'subject.max' => __('The subject field may not be greater than 120 characters.'),
            'phone_number.required'    => trans('plugins/contact::contact.form.phone_number.required'),
            'phone_number.regex' => __('The phone number field must contain only numbers and spaces.'),
            'phone_number.min' => __('The phone number field must be at least 10 characters.'),
            'phone_number.max' => __('The phone number field may not be greater than 20 characters.'),
            'email.required'   => trans('plugins/contact::contact.form.email.required'),
            'email.email'      => trans('plugins/contact::contact.form.email.email'),
            'email.max'        => __('The email field may not be greater than 60 characters.'),
            'content.required' => trans('plugins/contact::contact.form.content.required'),
            'g-recaptcha-response.required' => __('The recaptcha field is required.')
        ];
    }
}
