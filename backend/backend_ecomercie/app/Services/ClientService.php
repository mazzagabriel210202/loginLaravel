<?php

namespace App\Services;

use App\DTOs\Client\ClientCreateDTO;
use App\DTOs\Client\ClientUpdateDTO;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClientService
{
    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create(ClientCreateDTO $dto): Client
    {
        $this->validateUniqueFields($dto);

        return Client::create([
            'name'       => $dto->name,
            'email'      => $dto->email,
            'phone'      => $dto->phone,
            'cpf'        => $dto->cpf,
            'birth_date' => $dto->birth_date,
            'password'   => Hash::make($dto->password),
            'role'       => $dto->role->value,
            'active'     => $dto->active,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | READ - GET ALL
    |--------------------------------------------------------------------------
    */
    public function getAll()
    {
        return Client::query()
            ->latest()
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | READ - BY ID
    |--------------------------------------------------------------------------
    */
    public function findById(int $id): ?Client
    {
        return Client::find($id);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(int $id, ClientUpdateDTO $dto): Client
    {
        $client = Client::findOrFail($id);

        $this->validateUpdateUniqueFields($dto, $client->id);

        $data = $dto->toArray();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['role'])) {
            $data['role'] = $data['role']->value;
        }

        $client->update($data);

        return $client->refresh();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function delete(int $id): bool
    {
        $client = Client::find($id);

        if (!$client) {
            return false;
        }

        return $client->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATIONS - CREATE
    |--------------------------------------------------------------------------
    */
    private function validateUniqueFields(ClientCreateDTO $dto): void
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
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATIONS - UPDATE
    |--------------------------------------------------------------------------
    */
    private function validateUpdateUniqueFields(
        ClientUpdateDTO $dto,
        int $clientId
    ): void {
        if (
            $dto->email &&
            Client::where('email', $dto->email)
                ->where('id', '!=', $clientId)
                ->exists()
        ) {
            throw ValidationException::withMessages([
                'email' => 'E-mail já cadastrado.'
            ]);
        }

        if (
            $dto->cpf &&
            Client::where('cpf', $dto->cpf)
                ->where('id', '!=', $clientId)
                ->exists()
        ) {
            throw ValidationException::withMessages([
                'cpf' => 'CPF já cadastrado.'
            ]);
        }
    }
}