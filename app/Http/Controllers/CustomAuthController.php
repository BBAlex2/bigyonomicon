<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomAuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
        ], [
            'password.regex' => 'The password must contain at least one letter and one number.',
        ]);

        // Check if user exists
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // User exists, try to log in
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/store');
            }
        } else {
            // User doesn't exist, create a new one
            $user = User::create([
                'name' => explode('@', $credentials['email'])[0], // Use part of email as name
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);

            // Log in the new user
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/store');
        }

        // If we reach here, authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
        ], [
            'password.regex' => 'The password must contain at least one letter and one number.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if user exists
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // User exists, just log them in
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect('/store');
            }

            // If password doesn't match, update it
            $existingUser->password = Hash::make($request->password);
            $existingUser->save();

            Auth::login($existingUser);
            $request->session()->regenerate();
            return redirect('/store');
        } else {
            // User doesn't exist, create a new one
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log in the new user
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/store');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
