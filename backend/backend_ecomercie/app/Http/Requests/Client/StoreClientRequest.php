<?php

namespace App\Http\Requests\Client;

use App\Enums\ClientRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:clients,email',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'cpf' => [
                'required',
                'string',
                'max:14',
                'unique:clients,cpf',
            ],

            'birth_date' => [
                'required',
                'date',
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'max:255',
            ],

            'role' => [
                'nullable',
                new Enum(ClientRole::class),
            ],

            'active' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}