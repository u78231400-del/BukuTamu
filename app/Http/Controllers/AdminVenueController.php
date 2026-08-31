<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminVenueController extends Controller
{
    /**
     * Daftar semua venue
     */
    public function index()
    {
        $venues = Venue::latest()->get();

        return view('admin.venues.index', compact('venues'));
    }

    /**
     * Form tambah venue
     */
    public function create()
    {
        return view('admin.venues.create');
    }

    /**
     * Simpan venue baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_venue' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'lokasi' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'fasilitas' => ['nullable', 'array'],
            'status' => ['required', 'in:available,maintenance'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('venues', 'public');
        }

        $validated['slug'] = Str::slug($validated['nama_venue']);

        Venue::create($validated);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Venue berhasil ditambahkan.');
    }

    /**
     * Form edit venue
     */
    public function edit($id)
    {
        $venue = Venue::findOrFail($id);

        return view('admin.venues.edit', compact('venue'));
    }

    /**
     * Update venue
     */
    public function update(Request $request, $id)
    {
        $venue = Venue::findOrFail($id);

        $validated = $request->validate([
            'nama_venue' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'lokasi' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'fasilitas' => ['nullable', 'array'],
            'status' => ['required', 'in:available,maintenance'],
        ]);

        if ($request->hasFile('foto')) {

            if ($venue->foto && Storage::disk('public')->exists($venue->foto)) {
                Storage::disk('public')->delete($venue->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('venues', 'public');
        }

        $validated['slug'] = Str::slug($validated['nama_venue']);

        $venue->update($validated);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Venue berhasil diperbarui.');
    }

    /**
     * Nonaktifkan venue
     */
    public function destroy($id)
    {
        $venue = Venue::findOrFail($id);

        $venue->update([
            'status' => 'maintenance',
        ]);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Venue berhasil dinonaktifkan.');
    }

    /**
     * Aktifkan kembali venue
     */
    public function activate($id)
    {
        $venue = Venue::findOrFail($id);

        $venue->update([
            'status' => 'available',
        ]);

        return redirect()
            ->route('admin.venues.index')
            ->with('success', 'Venue berhasil diaktifkan kembali.');
    }
}