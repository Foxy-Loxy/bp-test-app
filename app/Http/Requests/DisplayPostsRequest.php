<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DisplayPostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'createdAt' => [
                Rule::in([
                    'ASC',
                    'DESC',
                ]),
            ],
            'user' => 'integer',
            'likes' => [
                Rule::in([
                    'ASC',
                    'DESC',
                ]),
            ],
        ];
    }

    protected $redirectRoute = 'home';
}
