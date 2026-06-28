<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserInfo;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // REGISTER
    public function register(StoreUserInfo $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, 
            // NOTE: In model Hashed is already set
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ]);
    }

    // LOGIN
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // LOGOUT (Protected)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
    public function forgetPassword(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent to your email if it exists in our system.',
            ]);
        }

        return response()->json([
            'message' => 'Failed to send password reset link.',
        ], 500);
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'Password reset successful.',
            ]);
        }

        return response()->json([
            'message' => 'Failed to reset password.',
        ], 500);
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully.',
        ]);
    }
}