<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBarangTransferRequest;
use App\Http\Requests\EditBarangTransferRequest;
use App\Models\BarangTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function barangsMasuk() {
        $barangsMasuk = BarangTransfer::where('jumlah', ">", 0)->paginate(10);
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barang.transfer', [
            'title' => 'List Barang Masuk',
            "barangs" => $barangsMasuk,
        ]);
    }
    
    public function barangsKeluar() {
        $barangsKeluar = BarangTransfer::where('jumlah', "<", 0)->paginate(10);
        return view('barang.transfer', [
            'title' => 'List Barang Keluar',
            "barangs" => $barangsKeluar,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the 'transfers' relationship to avoid N+1 queries
        $barangTransfers = BarangTransfer::paginate(10);
        return view('barang.transfer', [
            'title' => 'List Barang Masuk',
            'barangTransfers' => $barangTransfers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangTransfer.create', [
            'title' => 'New BarangTransfer',
            'barangTransfers' => BarangTransfer::paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBarangTransferRequest $request)
    {
        $dataBarangTransfer = $request->validate([
            "nama" => 'required',
            "deskripsi" => "nullable",    
        ]);
        BarangTransfer::create($dataBarangTransfer);
        return redirect('/barangTransfer/{id}')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangTransfer $barangTransfer)
    {
        return view('barangTransfer.edit', [
            "barangTransfer" => $barangTransfer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangTransfer $barangTransfer)
    {
        return view('barangTransfer.edit', [
            "barangTransfer" => $barangTransfer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangTransferRequest $request, BarangTransfer $barangTransfer)
    {
        $requestBarangTransfer = $request->validate([
            "nama" => 'required|string',
            "deskripsi" => "required|string",    
        ]);
        $barangTransfer->nama = $requestBarangTransfer['nama'];
        $barangTransfer->deskripsi = $requestBarangTransfer['deskripsi'];
        $barangTransfer->save();
        return redirect('/barangTransfer/{id}', [
            "barangTransfer" => $barangTransfer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangTransfer $barangTransfer)
    {
        $barangTransfer->delete();
        return redirect()->route('barangTransfer.index')->with('message', 'BarangTransfer deleted successfully!');
    }

    public function barangTransfersMasuk() {
        $barangTransfersMasuk = DB::table('barangTransfer_transfer')
            ->where('jumlah', ">", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barangTransfer.masuk', [
            "barangTransfers" => $barangTransfersMasuk,
        ]);
    }
    
    public function barangTransfersKeluar() {
        $barangTransfersKeluar = DB::table('barangTransfer_transfer')
            ->where('jumlah', "<", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barangTransfer.masuk', [
            "barangTransfers" => $barangTransfersKeluar,
        ]);
    }
}
