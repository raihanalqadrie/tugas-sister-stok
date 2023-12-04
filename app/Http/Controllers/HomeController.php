<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangTransfer;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUser = User::count();

        $totalBarang = Barang::count();

        $transfers = BarangTransfer::all();

        $totalPemasukan = 0;
        $totalPengeluaran = 0;

        foreach ($transfers as $transfer) {
            if ($transfer->tipe === 'masuk') {
                $totalPengeluaran += $transfer->jumlah * $transfer->harga_satuan;
            } else {
                $totalPemasukan += $transfer->jumlah * $transfer->harga_satuan;
            }
        }

        return view('home', [
            'title' => 'Dashboard',
            'totalUser' => $totalUser,
            'totalBarang' => $totalBarang,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
        ]);
    }
}
