<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $query = Appointment::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $appointments = $query->latest()->paginate(5)->appends($request->query());
        $totalAppointment = Appointment::count();
        $menunggu = Appointment::where('status', 'menunggu')->count();
        $disetujui = Appointment::where('status', 'disetujui')->count();

        return view('buat_janji', compact('appointments', 'totalAppointment', 'menunggu', 'disetujui'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2|max:100',
            'nomor_hp' => 'required|min:10|max:15|regex:/^[0-9]+$/',
            'tujuan' => 'required|min:2|max:100',
            'tanggal_janji' => 'required|date|after_or_equal:today',
            'jam_janji' => 'required',
            'pesan' => 'nullable|max:1000',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'nama.min' => 'Nama minimal 2 karakter!',
            'nama.max' => 'Nama maksimal 100 karakter!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'nomor_hp.min' => 'Nomor HP minimal 10 digit!',
            'nomor_hp.max' => 'Nomor HP maksimal 15 digit!',
            'nomor_hp.regex' => 'Nomor HP hanya boleh angka!',
            'tujuan.required' => 'Tujuan bertemu wajib diisi!',
            'tujuan.min' => 'Tujuan bertemu minimal 2 karakter!',
            'tujuan.max' => 'Tujuan bertemu maksimal 100 karakter!',
            'tanggal_janji.required' => 'Tanggal janji wajib diisi!',
            'tanggal_janji.after_or_equal' => 'Tanggal janji tidak boleh sebelum hari ini!',
            'jam_janji.required' => 'Jam janji wajib diisi!',
            'pesan.max' => 'Pesan maksimal 1000 karakter!',
        ]);

        Appointment::create($request->all());

        return redirect('/buat-janji')->with('success', 'Janji berhasil dibuat!');
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'disetujui']);
        return redirect('/buat-janji')->with('success', 'Janji berhasil disetujui!');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'ditolak']);
        return redirect('/buat-janji')->with('success', 'Janji berhasil ditolak!');
    }
}
