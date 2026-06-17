<?php

namespace App\DTOs\Client;

use Carbon\Carbon;

class ClientRegisterDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $cpf,
        public readonly Carbon|string $birth_date,
        public readonly string $password,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            cpf: $data['cpf'],
            birth_date: $data['birth_date'],
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf' => $this->cpf,
            'birth_date' => $this->birth_date,
            'password' => $this->password,
        ];
    }
}