<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroAlunosRequest extends FormRequest
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
            'nome' => 'required',
            'turno' => 'required',
            'data_nascimento' => 'required',
            'categoria' => 'required',
            'turmas_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'o campo nome é obrigatório',
            'turno.required' => 'o campo turno é obrigatório',
            'data_nascimento.required' => 'o data de nascimento nome é obrigatório',
            'categoria.required' => 'o campo categoria é obrigatório',
            'turmas_id.required' => 'o campo turma é obrigatório'
        ];
    }
}
