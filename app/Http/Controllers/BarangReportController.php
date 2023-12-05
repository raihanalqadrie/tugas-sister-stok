<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangTransfer;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class BarangReportController extends Controller
{
    public function download_report_stok_barang() {
        // Fetch data for the report (you might want to pass data from your database)
        $barangs = Barang::all();

        // Generate PDF using the view
        $pdf = PDF::setPaper('a4', 'portrait')->loadView('reports.report-stok-barang', compact('barangs'));

        // Or you can return the PDF as a download
        return $pdf->download('laporan-stok-barang.pdf');
    }

    public function download_report_barang_masuk() {
        $barangTransfers = BarangTransfer::with('barang')->where('tipe', "masuk")->orderBy('id', 'DESC')->get();

        // Generate PDF using the view
        $pdf = PDF::setPaper('a4', 'portrait')->loadView('reports.report-barang-masuk', compact('barangTransfers'));

        // Or you can return the PDF as a download
        return $pdf->download('laporan-barang-masuk.pdf');
    }

    public function download_report_barang_keluar() {
        $barangTransfers = BarangTransfer::with('barang')->where('tipe', "keluar")->orderBy('id', 'DESC')->get();

        // Generate PDF using the view
        $pdf = PDF::setPaper('a4', 'portrait')->loadView('reports.report-barang-keluar', compact('barangTransfers'));

        // Or you can return the PDF as a download
        return $pdf->download('laporan-barang-keluar.pdf');
    }
    
}
