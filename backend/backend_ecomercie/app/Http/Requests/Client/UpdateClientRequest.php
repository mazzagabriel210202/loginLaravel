<?php

namespace App\Http\Requests\Client;

use App\Enums\ClientRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $clientId = $this->route('id');

        return [
            'name' => [
                'sometimes',
                'string',
                'min:3',
                'max:255',
            ],

            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('clients', 'email')
                    ->ignore($clientId),
            ],

            'phone' => [
                'sometimes',
                'string',
                'max:20',
            ],

            'cpf' => [
                'sometimes',
                'string',
                'max:14',
                Rule::unique('clients', 'cpf')
                    ->ignore($clientId),
            ],

            'birth_date' => [
                'sometimes',
                'date',
            ],

            'password' => [
                'sometimes',
                'string',
                'min:6',
                'max:255',
            ],

            'role' => [
                'sometimes',
                new Enum(ClientRole::class),
            ],

            'active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Este e-mail já está cadastrado.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
        ];
    }
}