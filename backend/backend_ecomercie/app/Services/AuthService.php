<?php

namespace App\Services;

use App\DTOs\Client\ClientLoginDTO;
use App\DTOs\Client\ClientRegisterDTO;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function register(ClientRegisterDTO $dto): array
    {
        if (Client::where('email', $dto->email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'E-mail já cadastrado.'
            ]);
        }

        if (Client::where('cpf', $dto->cpf)->exists()) {
            throw ValidationException::withMessages([
                'cpf' => 'CPF já cadastrado.'
            ]);
        }

        $client = Client::create([
            'name'       => $dto->name,
            'email'      => $dto->email,
            'phone'      => $dto->phone,
            'cpf'        => $dto->cpf,
            'birth_date' => $dto->birth_date,
            'password'   => Hash::make($dto->password),
            'active'     => true,
        ]);

        $token = $client->createToken('auth_token')->plainTextToken;

        return [
            'user' => $client,
            'token' => $token,
        ];
    }

    public function login(ClientLoginDTO $dto): array
    {
        $client = Client::where('email', $dto->email)->first();

        if (!$client) {
            throw ValidationException::withMessages([
                'email' => 'Credenciais inválidas.'
            ]);
        }

        if (!$client->active) {
            throw ValidationException::withMessages([
                'email' => 'Usuário desativado.'
            ]);
        }

        if (!Hash::check($dto->password, $client->password)) {
            throw ValidationException::withMessages([
                'password' => 'Credenciais inválidas.'
            ]);
        }

        $token = $client->createToken('auth_token')->plainTextToken;

        return [
            'user' => $client,
            'token' => $token,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT (CORRIGIDO DEFINITIVO)
    |--------------------------------------------------------------------------
    */
    public function logout(): void
    {
        /** @var \App\Models\Client $user */
        $user = auth('sanctum')->user();

        /** @var PersonalAccessToken|null $token */
        $token = $user?->currentAccessToken();

        $token?->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT ALL DEVICES
    |--------------------------------------------------------------------------
    */
    public function logoutAll(): void
    {
        /** @var \App\Models\Client $user */
        $user = auth('sanctum')->user();

        $user?->tokens()->delete();
    }
}