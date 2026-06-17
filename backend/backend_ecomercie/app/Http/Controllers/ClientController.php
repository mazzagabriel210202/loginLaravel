<?php

namespace App\Http\Controllers;

use App\DTOs\Client\ClientCreateDTO;
use App\DTOs\Client\ClientUpdateDTO;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService $clientService
    ) {}

    /**
     * Lista todos os clientes
     */
    public function index(): JsonResponse
    {
        $clients = $this->clientService->getAll();

        return response()->json([
            'success' => true,
            'data' => $clients,
        ]);
    }

    /**
     * Cria um novo cliente
     */
    public function store(
        StoreClientRequest $request
    ): JsonResponse {
        $dto = ClientCreateDTO::fromArray(
            $request->validated()
        );

        $client = $this->clientService->create($dto);

        return response()->json([
            'success' => true,
            'message' => 'Cliente criado com sucesso.',
            'data' => $client,
        ], 201);
    }

    /**
     * Exibe um cliente específico
     */
    public function show(int $id): JsonResponse
    {
        $client = $this->clientService->findById($id);

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $client,
        ]);
    }

    /**
     * Atualiza um cliente
     */
    public function update(
        UpdateClientRequest $request,
        int $id
    ): JsonResponse {
        $dto = ClientUpdateDTO::fromArray(
            $request->validated()
        );

        $client = $this->clientService->update($id, $dto);

        return response()->json([
            'success' => true,
            'message' => 'Cliente atualizado com sucesso.',
            'data' => $client,
        ]);
    }

    /**
     * Remove um cliente
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->clientService->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cliente removido com sucesso.',
        ]);
    }

    
   
}