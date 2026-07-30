<?php

namespace Obii\InformationSection\Http\Requests;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class InformationSectionRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
