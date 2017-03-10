<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContatoRequest extends Request
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
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'endereco' => 'required|max:300',
            'telefone' => 'required|numeric',
            'img' => 'required|mimes:jpeg,jpg,bmp,png'
        ];
    }
}
