<?php

namespace App\Http\Controllers;

use App\Models\BarangTransfer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BarangReportController extends Controller
{
    public function download_report_stok_barang() {
        // Fetch data for the report (you might want to pass data from your database)
        $barangs = \App\Models\Barang::all();

        // Generate PDF using the view
        $pdf = Pdf::loadView('pdf.report', compact('barangs', 'transfers'));

        // Save or output the PDF
        // Example: Save the PDF to storage
        $pdf->save(storage_path('app/public/reports/report.pdf'));

        // Or you can return the PDF as a download
        // return $pdf->download('report.pdf');
    }

    public function download_report_barang_masuk() {
        $barangsMasuk = BarangTransfer::with('barang')->where('tipe', "masuk")->orderBy('id', 'DESC')->get();
    }

    public function download_report_barang_keluar() {
        $barangsKeluar = BarangTransfer::with('barang')->where('tipe', "keluar")->orderBy('id', 'DESC')->get();

    }
    
}
