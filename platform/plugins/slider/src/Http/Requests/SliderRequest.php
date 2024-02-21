<?php

namespace Obii\Slider\Http\Requests;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SliderRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   => 'required|max:191',
            'description'   => 'nullable|max:191',
            'title_button'   => 'nullable|max:191',
            'link'   => 'nullable|max:300',
            'image'   => 'required|max:300',
            'order'   => 'required|min:0|max:255',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
