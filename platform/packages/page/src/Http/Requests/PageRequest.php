<?php

namespace Obii\Page\Http\Requests;

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Page\Supports\Template;
use Obii\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class PageRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|max:120',
            'content'  => 'required',
            'template' => Rule::in(array_keys(Template::getPageTemplates())),
            'status'   => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
