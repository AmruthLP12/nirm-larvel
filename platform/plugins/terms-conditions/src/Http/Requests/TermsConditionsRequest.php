<?php

namespace Obii\TermsConditions\Http\Requests;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TermsConditionsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Basic info
            'application_no'         => 'nullable|string',
            'post_applied_for'       => 'required|string',
            'passport_photo'         => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'full_name'              => 'required|string|max:255',
            'gender'                 => 'required|in:Male,Female,Other',
            'father_name'            => 'required|string|max:255',
            'category'               => 'required|string|max:50',
            'other_category_specify' => 'required_if:category,OTHER|string|max:255',
            'caste_certificate'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dob'                    => 'required|date',
            'place_of_birth'         => 'required|string|max:255',
            'marital_status'         => 'required|in:Married,Single',

            // Address & contact
            'communication_address'  => 'required|string',
            'permanent_address'      => 'required|string',
            'contact_phone'          => 'required|string|regex:/^[0-9\-\+\s]{7,15}$/',
            'email_id'               => 'required|email',

            // Nationality
            'nationality'            => 'required|string',
            'citizen_india'          => 'required|boolean',
            'belong_state'           => 'nullable|string',
            'migrated'               => 'required|boolean',
            'nepal_sikkim'           => 'required|boolean',
            'religion'               => 'required|string',
            'religion_changed'       => 'required|boolean',

            // Work & experience
            'present_work_nature'    => 'required|string',
            'other_work_specify'     => 'required_if:present_work_nature,OTHER|string',
            'experience_details'     => 'nullable|string',

            // Publications counts
            'pub_international_journals_num'    => 'nullable|integer|min:0',
            'pub_national_journals_num'         => 'nullable|integer|min:0',
            'pub_international_conferences_num' => 'nullable|integer|min:0',
            'pub_national_conferences_num'      => 'nullable|integer|min:0',
            'pub_other_publications_num'        => 'nullable|integer|min:0',

            // Booleans / misc
            'outside_india'          => 'required|boolean',
            'suspended'              => 'required|boolean',
            'arrested'               => 'required|boolean',
            'endorsement_agreement'  => 'nullable|boolean',
            'endorsement_upload'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            // Pay & joining
            'accept_minimum_pay'     => 'required|boolean',
            'expected_pay'           => 'nullable|string',
            'joining_time'           => 'nullable|string',

            // Referees
            'referee1'               => 'required|string',
            'referee1_phone'         => 'required|string|regex:/^[0-9\-\+\s]{7,15}$/',
            'referee1_email'         => 'required|email',
            'referee2'               => 'required|string',
            'referee2_phone'         => 'required|string|regex:/^[0-9\-\+\s]{7,15}$/',
            'referee2_email'         => 'required|email',

            // Payment
            'payment_receipt_upload' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'application_fee_details'=> 'required|string',

            // Declaration
            'place_declaration'      => 'required|string',

            // Complex arrays (validate each as array, deeper validation via after hook)
            'education_details'      => 'nullable|array',
            'employment_details'     => 'nullable|array',
            'country_visits'         => 'nullable|array',
            'significant_publications' => 'nullable|array',
        ];
    }
}
