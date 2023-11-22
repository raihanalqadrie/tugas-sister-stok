<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('barang_transfer', function (Blueprint $table) {
            $table->integer("harga_satuan");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_transfer', function (Blueprint $table) {
            $table->removeColumn("harga_satuan");
        });
    }
};
