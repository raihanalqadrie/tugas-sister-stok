<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBarangTransferRequest;
use App\Http\Requests\EditBarangTransferRequest;
use App\Models\Barang;
use App\Models\BarangTransfer;

class BarangTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function barangsMasuk()
    {
        $barangsMasuk = BarangTransfer::where('jumlah', ">", 0)->paginate(10);
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barang.transfer.index', [
            'title' => 'List Barang Masuk',
            "barangTransfers" => $barangsMasuk,
        ]);
    }

    public function barangsKeluar()
    {
        $barangsKeluar = BarangTransfer::where('jumlah', "<", 0)->paginate(10);
        return view('barang.transfer.index', [
            'title' => 'List Barang Keluar',
            "barangTransfers" => $barangsKeluar,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->barangsMasuk();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.transfer.create', [
            'title' => 'Create Transfer',
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBarangTransferRequest $request)
    {
        BarangTransfer::create([
            'barang_id' => $request->barang_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'penerima' => $request->penerima,
        ]);
        return redirect('/barang/transfer/{id}')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangTransfer $barangTransfer)
    {
        return view('barang.transfer.edit', [
            'title' => 'Liat Transfer',
            "barangTransfer" => $barangTransfer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangTransfer $barangTransfer)
    {
        return view('barang.transfer.edit', [
            'title' => 'Liat Transfer',
            "barangTransfer" => $barangTransfer,
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangTransferRequest $request, BarangTransfer $barangTransfer)
    {
        $barangTransfer->nama = $request->nama;
        $barangTransfer->deskripsi = $request->deskripsi;
        $barangTransfer->jumlah = $request->jumlah;
        $barangTransfer->harga_satuan = $request->harga_satuan;
        $barangTransfer->penerima = $request->penerima;
        $barangTransfer->save();
        return redirect('/barang/transfer/{id}')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangTransfer $barangTransfer)
    {
        $barangTransfer->delete();
        if ($barangTransfer->jumlah > 0) {
            return redirect()->route('barang.transfer.masuk')->with('message', 'Barang Transfer deleted successfully!');
        } else {
            return redirect()->route('barang.transfer.keluar')->with('message', 'Barang Transfer deleted successfully!');
        }
    }
}