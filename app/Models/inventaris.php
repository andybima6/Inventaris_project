<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'inventaris';

    // Menentukan kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'status',
        'expired',
        'image_url',
    ];

    // Relasi dengan model User (bila diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
