<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: '/api/register',
        summary: 'Register a new user',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'phone', 'email', 'password'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Maher'),
                    new OA\Property(property: 'phone', type: 'string', example: '0512345678'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'maher@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'User registered successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $result = $authService->register($request->validated());

        return response()->json([
            'token' => $result['token'],
            'user' => $result['user'],
        ], 201);
    }

    #[OA\Post(
        path: '/api/login',
        summary: 'Login user and return token',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email_or_phone', 'password'],
                properties: [
                    new OA\Property(property: 'email_or_phone', type: 'string', example: 'maher@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Login successful'),
            new OA\Response(response: 401, description: 'Invalid credentials'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $validated = $request->validated();
        $result = $authService->login($validated['email_or_phone'], $validated['password']);

        return response()->json([
            'token' => $result['token'],
            'user' => $result['user'],
        ]);
    }

    #[OA\Get(
        path: '/api/account',
        summary: 'Get authenticated user profile',
        security: [['sanctum' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    #[OA\Put(
        path: '/api/account',
        summary: 'Update authenticated user profile',
        security: [['sanctum' => []]],
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'Maher Updated'),
                    new OA\Property(property: 'phone', type: 'string', example: '0598765432'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'updated@example.com')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Profile updated successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateAccountRequest $request, AuthService $authService): JsonResponse
    {
        $user = $authService->updateAccount($request->user(), $request->validated());

        return response()->json([
            'user' => $user,
        ]);
    }

    #[OA\Delete(
        path: '/api/account',
        summary: 'Delete authenticated user account',
        security: [['sanctum' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(response: 200, description: 'Account deleted successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function destroy(Request $request, AuthService $authService): JsonResponse
    {
        $authService->deleteAccount($request->user());

        return response()->json([
            'success' => true,
            'message' => 'Account deleted successfully.',
        ]);
    }
}