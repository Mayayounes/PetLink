<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        return User::with(['orders', 'appointments', 'adoptions'])->get();
    }

    public function store(Request $request)
    {
        // Handle both API and web requests
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Check if it's an API request
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        }

        // Web request - redirect to sign-in page with success message
        return redirect()->route('signIn.page')->with('success', 'Sign Up Successful! Please Sign In.');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if it's an API request
            if ($request->expectsJson() || $request->is('api/*')) {
                $user = Auth::user();
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user
                ]);
            }

            // Web request - redirect to home
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // Check if it's an API request
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Web request - back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function show($id)
    {
        return User::with(['orders', 'appointments', 'adoptions'])->findOrFail($id);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Logged out successfully']);
        }
        
        return redirect('/signIn');
    }
}