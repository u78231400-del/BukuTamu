<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected function isValidInternalPath(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST);
        $hostWhitelist = [request()->getHost(), 'localhost', '127.0.0.1'];

        if (!in_array($host, $hostWhitelist)) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH);
        $blockedPaths = ['/logout', '/login', '/register', '/admin', '/customer/dashboard'];

        foreach ($blockedPaths as $blocked) {
            if ($path === $blocked || str_starts_with($path, $blocked . '/')) {
                if ($blocked === '/customer/dashboard' && Auth::check() && Auth::user()->role === 'customer') {
                    continue;
                }
                return false;
            }
        }

        return true;
    }

    public function showRegister(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }
            return redirect()->route('dashboard');
        }

        $request->session()->put('register_redirect', $request->query('redirect', $request->session()->get('register_redirect')));

        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'customer',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        $redirectUrl = $request->input('redirect');

        if ($redirectUrl && $this->isValidInternalPath($redirectUrl)) {
            $request->session()->forget('register_redirect');
            return redirect($redirectUrl);
        }

        $sessionRedirect = $request->session()->get('register_redirect');
        if ($sessionRedirect && $this->isValidInternalPath($sessionRedirect)) {
            $request->session()->forget('register_redirect');
            return redirect($sessionRedirect);
        }

        if ($request->session()->has('url.intended')) {
            $intendedUrl = $request->session()->get('url.intended');
            if ($this->isValidInternalPath($intendedUrl)) {
                $request->session()->forget('url.intended');
                $request->session()->forget('register_redirect');
                return redirect($intendedUrl);
            }
        }

        $request->session()->forget('register_redirect');

        return redirect()->intended(route('customer.dashboard'));
    }
}