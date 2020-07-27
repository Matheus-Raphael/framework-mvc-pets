<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'name'        => 'required|string',
            'description' => 'required|string',
            'age'         => 'required|numeric',
            'users_id'    => 'required|numeric|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'O campo nome é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'age.required'         => 'O campo idade é obrigatório',
            'users_id.required'    => 'O campo usuário é obrigatório',
            'age.numeric'          => 'Informe um valor numérico para a idade',
            'users_id.numeric'     => 'Informe um valor numérico para o usuário',
            'users_id.exists'      => 'Informe um usuário cadastrado'
        ];
    }
}
