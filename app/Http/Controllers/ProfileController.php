<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;

        return view('profile.index', compact('user', 'role'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $role = $user->role;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah digunakan oleh pengguna lain.',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $routeMap = [
            'admin' => 'admin.profile',
            'owner' => 'owner.profile',
            'customer' => 'customer.profile',
        ];

        return redirect()
            ->route($routeMap[$role] ?? 'customer.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
