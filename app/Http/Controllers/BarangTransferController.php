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
        $barangsMasuk = BarangTransfer::with('barang')->where('tipe', "masuk")->orderBy('id', 'DESC')->paginate(10);
        return view('barang-transfer.index', [
            'title' => 'List Barang Masuk',
            "barangTransfers" => $barangsMasuk,
        ]);
    }

    public function barangsKeluar()
    {
        $barangsKeluar = BarangTransfer::with('barang')->where('tipe', "keluar")->orderBy('id', 'DESC')->paginate(10);
        return view('barang-transfer.index', [
            'title' => 'List Barang Keluar',
            "barangTransfers" => $barangsKeluar,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangTransfers = BarangTransfer::with('barang')->orderBy('id', 'DESC')->paginate(10);
        return view('barang-transfer.index', [
            'title' => 'List Barang Masuk/Keluar',
            "barangTransfers" => $barangTransfers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-transfer.create', [
            'title' => 'Create Transfer',
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBarangTransferRequest $request)
    {
        $barangTransfer = BarangTransfer::create([
            'barang_id' => $request->barang_id,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga_satuan,
            'penerima' => $request->penerima,
        ]);
        return redirect()
            ->route('barang-transfer.edit', [$barangTransfer->id])
            ->with('success', 'Data barang '.$barangTransfer->tipe.' berhasil di create');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangTransfer $barangTransfer)
    {
        return view('barang-transfer.edit', [
            'title' => 'Edit Transfer',
            "barangTransfer" => $barangTransfer,
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangTransfer $barangTransfer)
    {
        return view('barang-transfer.edit', [
            'title' => 'Edit Transfer',
            "barangTransfer" => $barangTransfer,
            'barangs' => Barang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangTransferRequest $request, BarangTransfer $barangTransfer)
    {
        $barangTransfer->deskripsi = $request->deskripsi;
        $barangTransfer->tipe = $request->tipe;
        $barangTransfer->jumlah = $request->jumlah;
        $barangTransfer->harga_satuan = $request->harga_satuan;
        $barangTransfer->penerima = $request->penerima;
        $barangTransfer->save();
        return redirect()
            ->route('barang-transfer.edit', [$barangTransfer->id])
            ->with('success', 'Data barang '.$barangTransfer->tipe.' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangTransfer $barangTransfer)
    {
        $barangTransfer->delete();
        return redirect()->route('barang-transfer.index')->with('success', 'Data barang '.$barangTransfer->tipe.' berhasil di delete');
    }
}
