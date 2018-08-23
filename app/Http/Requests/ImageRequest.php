<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
        switch ($this->method()) {

            case 'POST': {
                return [
                    'imageContenu'=>'required|image',
                ];
            }

        }
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        switch ($this->method()) {

            case 'POST': {
                return [
                    'imageContenu.required' => 'Vous n\'avez pas mis d\'Image',
                    'imageContenu.image' => 'Ceci n\'est pas une image',
                ];
            }
        }
    }
}
