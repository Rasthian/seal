<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function getProfileById($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found', 404);
            }
            $status = 'success';
            $message = 'User profile retrieved successfully';
            $status_code = 200;
            $data = [
                'user' => $user,
                'image_url' => asset('storage/images/' . $user->image),
            ];
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to retrieve user profile: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }


    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $user->image = basename($imagePath);
                $user->save();
            }


            $status = 'success';
            $message = 'User registered successfully';
            $status_code = 201;
            $data = [
                'user' => $user
            ];
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to register user: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }


    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw new \Exception('Invalid credentials', 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            $status = 'success';
            $message = 'Login successful';
            $status_code = 200;
            $data = [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ];
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to login: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $authenticatedUser = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|max:255|unique:users,email,' . $authenticatedUser->id,
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'sometimes|required|string|min:8'
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 400);
            }

            if ($request->has('name')) {
                $authenticatedUser->name = $request->name;
            }

            if ($request->has('email')) {
                $authenticatedUser->email = $request->email;
            }

            if ($request->has('password')) {
                $authenticatedUser->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                if ($authenticatedUser->image) {
                    Storage::delete('public/images/' . $authenticatedUser->image);
                }

                $imagePath = $request->file('image')->store('images', 'public');
                $authenticatedUser->image = basename($imagePath);
            }

            $authenticatedUser->save();

            $status = 'success';
            $message = 'User updated successfully';
            $status_code = 200;
            $data = [
                'user' => $authenticatedUser,
                'image_url' => asset('storage/images/' . $authenticatedUser->image),
            ];
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to update user: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }






    public function deleteUser($id, Request $request)
    {
        try {

            $user = User::find($id);

            if (!$user) {
                throw new \Exception('User not found', 404);
            }
            $user->delete();

            $status = 'success';
            $message = 'User deleted successfully';
            $status_code = 200;
            $data = null;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to delete user: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }


    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();

            $status = 'success';
            $message = 'Logout successful';
            $status_code = 200;
            $data = null;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Failed to logout: ' . $e->getMessage();
            $status_code = $e->getCode() ?: 500;
            $data = null;
        } finally {
            return response()->json(compact('status', 'message', 'data'), $status_code);
        }
    }
}
