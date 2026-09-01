<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerVenueController extends Controller
{
    public function index()
    {
        $venues = Venue::where('owner_id', Auth::id())->latest()->get();

        return view('owner.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('owner.venues.create');
    }

    public function show($id)
    {
        $venue = Venue::where('owner_id', Auth::id())->findOrFail($id);

        return view('owner.venues.show', compact('venue'));
    }

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
        $validated['owner_id'] = Auth::id();

        Venue::create($validated);

        return redirect()
            ->route('owner.venues.index')
            ->with('success', 'Venue berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $venue = Venue::where('owner_id', Auth::id())->findOrFail($id);

        return view('owner.venues.edit', compact('venue'));
    }

    public function update(Request $request, $id)
    {
        $venue = Venue::where('owner_id', Auth::id())->findOrFail($id);

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
            ->route('owner.venues.index')
            ->with('success', 'Venue berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $venue = Venue::where('owner_id', Auth::id())->findOrFail($id);

        if ($venue->foto && Storage::disk('public')->exists($venue->foto)) {
            Storage::disk('public')->delete($venue->foto);
        }

        $venue->delete();

        return redirect()
            ->route('owner.venues.index')
            ->with('success', 'Venue berhasil dihapus.');
    }
}
