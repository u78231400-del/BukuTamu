<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function isValidInternalPath(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST);
        $hostWhitelist = [request()->getHost(), 'localhost', '127.0.0.1'];

        if (!in_array($host, $hostWhitelist)) {
            return false;
        }

        $path = parse_url($url, PHP_URL_PATH);
        $blockedPaths = [
            '/logout',
            '/login',
            '/register',
            '/admin',
            '/customer/dashboard'
        ];

        foreach ($blockedPaths as $blocked) {
            if ($path === $blocked || str_starts_with($path, $blocked . '/')) {

                if (
                    $blocked === '/customer/dashboard' &&
                    Auth::check() &&
                    Auth::user()->role === 'customer'
                ) {
                    continue;
                }

                return false;
            }
        }

        return true;
    }

    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('login');
        }

        $request->session()->put(
            'login_redirect',
            $request->query(
                'redirect',
                $request->session()->get('login_redirect')
            )
        );

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $redirectUrl = $request->input('redirect');

            if (
                $redirectUrl &&
                $this->isValidInternalPath($redirectUrl)
            ) {
                $request->session()->forget('login_redirect');

                return redirect($redirectUrl);
            }

            $sessionRedirect = $request->session()->get('login_redirect');

            if (
                $sessionRedirect &&
                $this->isValidInternalPath($sessionRedirect)
            ) {
                $request->session()->forget('login_redirect');

                return redirect($sessionRedirect);
            }

            if ($request->session()->has('url.intended')) {

                $intendedUrl = $request->session()->get('url.intended');

                if ($this->isValidInternalPath($intendedUrl)) {

                    $request->session()->forget('url.intended');
                    $request->session()->forget('login_redirect');

                    return redirect($intendedUrl);
                }
            }

            $request->session()->forget('login_redirect');

            // CUSTOMER
            if (Auth::user()->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }

            // ADMIN
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('login');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
