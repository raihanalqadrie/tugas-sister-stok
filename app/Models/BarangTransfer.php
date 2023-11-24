<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangTransfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barang_id', 'deskripsi', 'tipe', "jumlah", "harga_satuan", "penerima"
    ];

    /**
     * We want to enforce the property type
     * might be useful to solve a common bug when the
     * database doesn't return the right type.
     */
    protected $casts = [
        'barang_id' => 'float',
        'jumlah' => 'float',
        'harga_satuan' => 'float',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
