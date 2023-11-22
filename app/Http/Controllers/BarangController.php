<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBarang = Barang::all();
        // TODO: append stock property to every object inside the barang list
        return view('dashboard.barang.index', [
            "listBarang" => $listBarang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataBarang = $request->validate([
            "nama" => 'required|string',
            "deskripsi" => "required|string",    
        ]);
        Barang::create($dataBarang);
        return redirect('/dashboard/barang')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = DB::table('barang')->find($id);
        return view('dashboard.barang.show', [
            "barang" => $barang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = DB::table('barang')->find($id);
        return view('dashboard.barang.edit', [
            "barang" => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestBarang = $request->validate([
            "nama" => 'required|string',
            "deskripsi" => "required|string",    
        ]);
        $barang = Barang::update($requestBarang);
        return redirect('/dashboard/barang/show', [
            "barang" => $barang,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Barang::destroy($id);
    }

    public function listBarangMasuk() {
        $listBarangMasuk = DB::table('barang_transfer')
            ->where('jumlah', ">", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('dashboard.barang.masuk', [
            "listBarang" => $listBarangMasuk,
        ]);
    }
    
    public function listBarangKeluar() {
        $listBarangKeluar = DB::table('barang_transfer')
            ->where('jumlah', "<", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('dashboard.barang.masuk', [
            "listBarang" => $listBarangKeluar,
        ]);
    }
}
