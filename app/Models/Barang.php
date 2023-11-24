<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Barang extends Model
{
    use HasFactory, Notifiable;

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
        $quantities = $barang
            ->transfers()
            ->get()
            ->map( fn( $transfer ) => $transfer->qty )
            ->toArray();
        return collect($quantities)->sum();
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(BarangTransfer::class, 'barang_id', 'id');
    }
}
