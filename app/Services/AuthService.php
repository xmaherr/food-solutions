<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'client',
        ]);

        return [
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
        ];
    }

    public function login(string $emailOrPhone, string $password): array
    {
        $user = User::query()
            ->where(function ($query) use ($emailOrPhone) {
                $query->where('email', $emailOrPhone)
                    ->orWhere('phone', $emailOrPhone);
            })
            ->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email_or_phone' => ['بيانات الدخول غير صحيحة.'],
            ]);
        }

        return [
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
        ];
    }

    public function updateAccount(User $user, array $data): User
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return $user->fresh();
    }

    public function deleteAccount(User $user): void
    {
        $user->tokens()->delete();
        $user->delete();
    }
}
