<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Tamu;
use App\Models\Appointment;
use App\Exports\TamuExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tamus = Tamu::when($search, function ($query, $search) {
                        return $query->where('nama', 'like', "%{$search}%")
                                     ->orWhere('email', 'like', "%{$search}%")
                                     ->orWhere('nomor_hp', 'like', "%{$search}%")
                                     ->orWhere('instansi', 'like', "%{$search}%")
                                     ->orWhere('keperluan', 'like', "%{$search}%")
                                     ->orWhere('tujuan', 'like', "%{$search}%")
                                     ->orWhere('pesan', 'like', "%{$search}%");
                    })
                    ->latest()
                    ->paginate(3)
                    ->withQueryString();

        $totalTamu = Tamu::count();
        $tamuHariIni = Tamu::whereDate('created_at', Carbon::today())->count();
        $tamuBulanIni = Tamu::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();

        return view('bukutamu', compact('tamus', 'totalTamu', 'tamuHariIni', 'tamuBulanIni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2|max:100',
            'jumlah_orang' => 'required|integer|min:1',
            'nomor_hp' => 'required|min:10|max:15|regex:/^[0-9]+$/',
            'tujuan' => 'required|min:2|max:100',
            'pesan' => 'nullable|max:1000',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'nama.min' => 'Nama minimal 2 karakter!',
            'nama.max' => 'Nama maksimal 100 karakter!',
            'jumlah_orang.required' => 'Jumlah orang wajib diisi!',
            'jumlah_orang.integer' => 'Jumlah orang harus angka!',
            'jumlah_orang.min' => 'Jumlah orang minimal 1!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'nomor_hp.min' => 'Nomor HP minimal 10 digit!',
            'nomor_hp.max' => 'Nomor HP maksimal 15 digit!',
            'nomor_hp.regex' => 'Nomor HP hanya boleh angka!',
            'tujuan.required' => 'Tujuan bertemu wajib diisi!',
            'tujuan.min' => 'Tujuan bertemu minimal 2 karakter!',
            'tujuan.max' => 'Tujuan bertemu maksimal 100 karakter!',
            'pesan.max' => 'Pesan maksimal 1000 karakter!',
        ]);

        Tamu::create([
            'nama' => $request->nama,
            'jumlah_orang' => $request->jumlah_orang,
            'nomor_hp' => $request->nomor_hp,
            'tujuan' => $request->tujuan,
            'pesan' => $request->pesan,
        ]);

        return redirect('/bukutamu')->with('success', 'Pesan berhasil terkirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('edit_tamu', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|min:3|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'nullable|email|max:100',
            'nomor_hp' => 'required|min:10|max:15|regex:/^[0-9]+$/',
            'instansi' => 'required|min:2|max:100',
            'keperluan' => 'required|min:3|max:100',
            'tujuan' => 'required|min:3|max:100',
            'pesan' => 'nullable|max:1000',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'nama.min' => 'Nama minimal 3 huruf!',
            'nama.max' => 'Nama maksimal 100 huruf!',
            'nama.regex' => 'Nama hanya boleh huruf dan spasi!',
            'email.email' => 'Format email tidak valid!',
            'email.max' => 'Email maksimal 100 karakter!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'nomor_hp.min' => 'Nomor HP minimal 10 digit!',
            'nomor_hp.max' => 'Nomor HP maksimal 15 digit!',
            'nomor_hp.regex' => 'Nomor HP hanya boleh angka!',
            'instansi.required' => 'Asal Instansi/Kota wajib diisi!',
            'instansi.min' => 'Asal Instansi/Kota minimal 2 huruf!',
            'instansi.max' => 'Asal Instansi/Kota maksimal 100 huruf!',
            'keperluan.required' => 'Keperluan wajib diisi!',
            'keperluan.min' => 'Keperluan minimal 3 karakter!',
            'keperluan.max' => 'Keperluan maksimal 100 karakter!',
            'tujuan.required' => 'Tujuan bertemu wajib diisi!',
            'tujuan.min' => 'Tujuan bertemu minimal 3 karakter!',
            'tujuan.max' => 'Tujuan bertemu maksimal 100 karakter!',
            'pesan.max' => 'Pesan maksimal 1000 karakter!',
        ]);

        $tamu = Tamu::findOrFail($id);
        $tamu->update($request->all());
        return redirect('/bukutamu')->with('success', 'Pesan berhasil diperbarui!');
    }

    public function destroy($id)
    {
    DB::table('tamus')->where('id', $id)->delete();
    return redirect('/bukutamu')->with('success', 'Data berhasil dihapus!');
    }

public function export(Request $request)
{
    $filter = $request->input('filter', 'semua');

    $filename = match ($filter) {
        'mingguan' => 'data-tamu-mingguan-' . Carbon::now()->format('Y-m-d') . '.xlsx',
        'bulanan' => 'data-tamu-bulanan-' . Carbon::now()->format('F-Y') . '.xlsx',
        default => 'data-tamu-semua-' . Carbon::now()->format('Y-m-d') . '.xlsx',
    };

    return Excel::download(new TamuExport($filter), $filename);
}

public function dashboard()
{
    $totalTamu = Tamu::count();
    $tamuHariIni = Tamu::whereDate('created_at', Carbon::today())->count();
    $tamuMingguIni = Tamu::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $tamuBulanIni = Tamu::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count();
    
    $hariTerakhir = [];
    $labels7hari = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i);
        $labels7hari[] = $date->format('d M');
        $hariTerakhir[] = Tamu::whereDate('created_at', $date)->count();
    }
    
    $tamuTerbaru = Tamu::latest()->take(5)->get();
    
    $dataPerBulan = [];
    $labelsBulan = [];
    for ($i = 1; $i <= 12; $i++) {
        $labelsBulan[] = Carbon::create()->month($i)->format('M');
        $dataPerBulan[] = Tamu::whereMonth('created_at', $i)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->count();
    }

    $totalAppointment = Appointment::count();
    $appointmentMenunggu = Appointment::where('status', 'menunggu')->count();
    $appointmentDisetujui = Appointment::where('status', 'disetujui')->count();
    $appointmentDitolak = Appointment::where('status', 'ditolak')->count();
    
    return view('dashboard', compact(
        'totalTamu', 
        'tamuHariIni', 
        'tamuMingguIni', 
        'tamuBulanIni',
        'hariTerakhir',
        'labels7hari',
        'tamuTerbaru',
        'dataPerBulan',
        'labelsBulan',
        'totalAppointment',
        'appointmentMenunggu',
        'appointmentDisetujui',
        'appointmentDitolak'
    ));
}
}
