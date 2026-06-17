<?php

namespace App\Http\Controllers;

use App\DTOs\Client\ClientLoginDTO;
use App\DTOs\Client\ClientRegisterDTO;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {
        $dto = ClientRegisterDTO::fromArray($request->all());

        $result = $this->authService->register($dto);

        return response()->json([
            'message' => 'Cadastro realizado com sucesso.',
            'data' => $result
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $dto = ClientLoginDTO::fromArray($request->all());

        $result = $this->authService->login($dto);

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'data' => $result
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout()
    {
        $this->authService->logout();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT ALL DEVICES
    |--------------------------------------------------------------------------
    */
    public function logoutAll()
    {
        $this->authService->logoutAll();

        return response()->json([
            'message' => 'Logout de todos os dispositivos realizado.'
        ]);
    }
}