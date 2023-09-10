<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'bail|required|min:3',
            'phone'         => 'bail|required|min:10',
            'email'         => 'bail|required|email',
            'category_id'   => 'bail|required|min:1|exists:categories,id'


        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Nome',
            'phone'         => 'Telefone',
            'email'         => 'E-mail',
            'category_id'   => 'Categoria'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
