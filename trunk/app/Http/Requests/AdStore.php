<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdStore extends FormRequest
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
            'title' => ['required'], // il peut y avoir plusieurs titres je ne vois pas où est le prblm à ça ,'unique:ads'
            'description' => 'required',
            'localisation' => ['required'],
            'nbr_vue',
            'user_id' => ['required'],
        ];
    }
}
