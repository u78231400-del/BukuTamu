<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Exports\AppointmentExport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $query = Appointment::query();

        if ($request->has('search') && $request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest()->paginate(5)->appends($request->query());
        $totalAppointment = Appointment::count();
        $menunggu = Appointment::where('status', 'menunggu')->count();
        $disetujui = Appointment::where('status', 'disetujui')->count();
        $ditolak = Appointment::where('status', 'ditolak')->count();

        return view('buat_janji', compact('appointments', 'totalAppointment', 'menunggu', 'disetujui', 'ditolak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2|max:100',
            'nomor_hp' => 'required|min:10|max:15|regex:/^[0-9]+$/',
            'tujuan' => 'required|min:2|max:100',
            'tanggal_janji' => 'required|date|after_or_equal:today',
            'jam_janji' => 'required',
            'jumlah_orang' => 'required|integer|min:1|max:100',
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
            'jumlah_orang.required' => 'Jumlah orang wajib diisi!',
            'jumlah_orang.integer' => 'Jumlah orang harus angka!',
            'jumlah_orang.min' => 'Jumlah orang minimal 1!',
            'jumlah_orang.max' => 'Jumlah orang maksimal 100!',
            'pesan.max' => 'Pesan maksimal 1000 karakter!',
        ]);

        $existing = Appointment::where('tanggal_janji', $request->tanggal_janji)
                               ->where('jam_janji', $request->jam_janji)
                               ->exists();

        if ($existing) {
            return redirect('/buat-janji')
                ->withInput()
                ->with('error', 'Janji pada tanggal dan jam tersebut sudah terisi!');
        }

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

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect('/buat-janji')->with('success', 'Janji berhasil dihapus!');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('edit_appointment', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:2|max:100',
            'nomor_hp' => 'required|min:10|max:15|regex:/^[0-9]+$/',
            'tujuan' => 'required|min:2|max:100',
            'tanggal_janji' => 'required|date',
            'jam_janji' => 'required',
            'jumlah_orang' => 'required|integer|min:1|max:100',
            'pesan' => 'nullable|max:1000',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect('/buat-janji')->with('success', 'Janji berhasil diperbarui!');
    }

    public function export(Request $request)
    {
        $status = $request->status;
        $filename = 'janji_tamu_' . ($status ?? 'semua') . '_' . date('d_m_Y') . '.xlsx';
        return Excel::download(new AppointmentExport($status), $filename);
    }
}
