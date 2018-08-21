<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentaireRequest extends FormRequest
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
                    'id_Commentaire'=>'required|max:255|integer',
                    'Reponse' => 'required|max:255|string',
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
                    'Reponse.required' => 'Vous n\'avez pas mis de réponse',
                    'Reponse.string' => 'vous n\'avez pas rentré une chaine de caractères',
                    'Reponse.max:255' => 'Votre réponse est trop longue',
                    'id_Commentaire' => 'Erreur d\'id, essayez de recommencer après avoir rafraîchit la page',
                ];
            }
        }
    }
}
