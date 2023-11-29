<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBarangRequest;
use App\Http\Requests\EditBarangRequest;
use App\Models\Barang;
use Exception;
use Illuminate\Support\Facades\Log;

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
        // Eager load the 'transfers' relationship to avoid N+1 queries
        $barangs = Barang::with('transfers')->orderBy('id', 'DESC')->get();

        // // Append stock property to every object inside the barang list
        // foreach ($barangs as $barang) {
        //     // Calculate stock by summing the quantity from the loaded relationship
        //     $barang->stock = $barang->barangTransfers->sum('qty');
        //     ddd($barang);
        // }

        return view('barang.index', [
            'title' => 'List Barang',
            'barangs' => $barangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create', [
            'title' => 'Create Barang',
            'barangs' => Barang::paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddBarangRequest $request)
    {
        try {
            $barang = Barang::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect()->route('barang.index', [$barang->id])->with('sukses', 'Barang berhasil di tambahkan');
        } catch (Exception $e) {
            Log::error('Error adding barang: ' . $e->getMessage());
            return redirect()->route('barang.index')->with('gagal', 'Barang gagal di tambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('barang.edit', [
            'title' => 'Edit Barang',
            "barang" => $barang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'title' => 'Edit Barang',
            "barang" => $barang,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBarangRequest $request, Barang $barang)
    {
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->save();
        return redirect()->route('barang.index', [$barang->id])->with('sukses', 'Barang berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('sukses', 'Barang berhasil dihapus');
    }
}
