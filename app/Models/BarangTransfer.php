<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'barnag_id', "jumlah", 'deskripsi', "penerima"
    ];


    /**
     * Get the stock.
     *
     * @return int
     */
    public function getStockAttribute()
    {

    }
}
