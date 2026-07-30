<?php

namespace Obii\TermsConditions\Models;

use Obii\Base\Traits\EnumCastable;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Models\BaseModel;

class TermsConditions extends BaseModel
{
    use EnumCastable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'terms_conditions';

    /**
     * @var array
     */
    protected $fillable = [
        'application_no',
        'post_applied_for',
        'passport_photo',
        'full_name',
        'gender',
        'father_name',
        'category',
        'other_category_specify',
        'caste_certificate',
        'dob',
        'birth_certificate',
        'place_of_birth',
        'marital_status',
        'communication_address',
        'permanent_address',
        'contact_phone',
        'email_id',
        'nationality',
        'citizen_india',
        'belong_state',
        'migrated',
        'basic_degree_type',
        'science_education_details',
        'engineering_education_details',
        'nepal_sikkim',
        'religion',
        'religion_changed',
        'present_work_nature',
        'other_work_specify',
        'experience_details',
        'outside_india',
        'suspended',
        'arrested',
        'endorsement_agreement',
        'endorsement_upload',
        'accept_minimum_pay',
        'expected_pay',
        'joining_time',
        'referee1',
        'referee1_phone',
        'referee1_email',
        'referee2',
        'referee2_phone',
        'referee2_email',
        'place_declaration',
        'education_details',
        'employment_details',
        'country_visits',
        'significant_publications',
        'pub_international_journals_num',
        'pub_national_journals_num',
        'pub_international_conferences_num',
        'pub_national_conferences_num',
        'pub_other_publications_num',
        'payment_receipt_upload',
        'application_fee_details',
        'govt_servant',
        'appointment_nature',
    ];

    /**
     * @var array
     */
    protected $casts = [
        // JSON/array casts
        'education_details'            => 'array',
        'employment_details'           => 'array',
        'science_education_details'    => 'array',
        'engineering_education_details'=> 'array',
        'country_visits'               => 'array',
        'significant_publications'     => 'array',

        // Boolean flags
        'citizen_india'        => 'boolean',
        'migrated'             => 'boolean',
        'nepal_sikkim'         => 'boolean',
        'religion_changed'     => 'boolean',
        'outside_india'        => 'boolean',
        'suspended'            => 'boolean',
        'arrested'             => 'boolean',
        'endorsement_agreement'=> 'boolean',
        'accept_minimum_pay'   => 'boolean',
        'govt_servant'         => 'boolean',

        // Numeric counts
        'pub_international_journals_num'     => 'integer',
        'pub_national_journals_num'          => 'integer',
        'pub_international_conferences_num'  => 'integer',
        'pub_national_conferences_num'       => 'integer',
        'pub_other_publications_num'         => 'integer',
    ];
}
