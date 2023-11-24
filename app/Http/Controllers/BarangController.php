<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBarangRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Barang;
use App\Models\BarangTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the 'barang_transfers' relationship to avoid N+1 queries
        $barangs = Barang::with('barang_transfers')->paginate(10);

        // Append stock property to every object inside the barang list
        foreach ($barangs as $barang) {
            // Calculate stock by summing the quantity from the loaded relationship
            $barang->stock = $barang->barangTransfers->sum('qty');
            ddd($barang);
        }

        return view('barang.index', [
            'barangs' => $barangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create', [
            'title' => 'New Barang',
            'barangs' => Barang::paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBarangRequest $request)
    {
        $dataBarang = $request->validate([
            "nama" => 'required',
            "deskripsi" => "nullable",    
        ]);
        Barang::create($dataBarang);
        return redirect('/barang/{id}')->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.edit', [
            "barang" => $barang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            "barang" => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangRequest $request, Barang $barang)
    {
        $requestBarang = $request->validate([
            "nama" => 'required|string',
            "deskripsi" => "required|string",    
        ]);
        $barang->nama = $requestBarang['nama'];
        $barang->deskripsi = $requestBarang['deskripsi'];
        $barang->save();
        return redirect('/barang/{id}', [
            "barang" => $barang,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('message', 'Barang deleted successfully!');
    }

    public function barangsMasuk() {
        $barangsMasuk = DB::table('barang_transfer')
            ->where('jumlah', ">", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barang.masuk', [
            "barangs" => $barangsMasuk,
        ]);
    }
    
    public function barangsKeluar() {
        $barangsKeluar = DB::table('barang_transfer')
            ->where('jumlah', "<", 0)
            ->get();
        // return tanggal, nm brg, jmlh, ketrangan, id
        return view('barang.masuk', [
            "barangs" => $barangsKeluar,
        ]);
    }
}
