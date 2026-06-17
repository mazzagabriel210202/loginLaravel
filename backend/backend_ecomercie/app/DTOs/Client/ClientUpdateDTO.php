<?php

namespace App\DTOs\Client;

use App\Enums\ClientRole;
use Carbon\Carbon;

class ClientUpdateDTO
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $email = null,
        public readonly ?string $phone = null,
        public readonly ?string $cpf = null,
        public readonly Carbon|string|null $birth_date = null,
        public readonly ?string $password = null,
        public readonly ?ClientRole $role = null,
        public readonly ?bool $active = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            cpf: $data['cpf'] ?? null,
            birth_date: $data['birth_date'] ?? null,
            password: $data['password'] ?? null,
            role: isset($data['role'])
                ? ClientRole::from($data['role'])
                : null,
            active: $data['active'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf' => $this->cpf,
            'birth_date' => $this->birth_date,
            'password' => $this->password,
            'role' => $this->role,
            'active' => $this->active,
        ], fn ($value) => !is_null($value));
    }
}