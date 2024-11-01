<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Rate limit login attempts
        $this->ensureIsNotRateLimited($request);

        $remember = $request->boolean('remember'); // Use boolean casting for 'remember'

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Prevent session fixation attacks

            // Clear failed login attempts on success
            RateLimiter::clear($this->throttleKey($request));

            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // Increment failed attempts and throw validation exception
        RateLimiter::hit($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect or the account does not exist.'],
        ]);
    }

    // Ensure login attempts are not rate-limited
    protected function ensureIsNotRateLimited(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw ValidationException::withMessages([
                'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($this->throttleKey($request)) . ' seconds.'],
            ])->status(429); // HTTP status 429 for too many requests
        }
    }

    // Generate a unique throttle key for the user login attempt
    protected function throttleKey(Request $request): string
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => 3, // Assign default role (e.g., "user" role)
            ]);

            Auth::login($user); // Log in the user after registration

            return redirect('/')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
