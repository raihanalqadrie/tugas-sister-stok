<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class BarangTransfer extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'barang_id', 'deskripsi', "jumlah", "harga_satuan", "penerima"
    ];


    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangTransfer::class, 'id', 'barang_id');
    }
}
