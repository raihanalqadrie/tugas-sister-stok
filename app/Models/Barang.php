<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'deskripsi',
    ];


    /**
     * Get the stock.
     *
     * @return int
     */
    public function getStockAttribute()
    {
        $barang = $this->find($this->id);
        $jumlahTotal = $barang
            ->transfers()
            ->get()
            ->map(fn ($transfer) => $transfer->tipe === 'masuk' ? $transfer->jumlah : -$transfer->jumlah)
            ->toArray();
        return collect($jumlahTotal)->sum();
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(BarangTransfer::class, 'barang_id', 'id');
    }
}
