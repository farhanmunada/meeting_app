<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $table = 'ruang';
    protected $fillable = ['nama_ruang', 'kapasitas', 'lokasi'];

    // Relasi: satu ruang bisa punya banyak rapat
    public function rapat()
    {
        return $this->hasMany(Rapat::class);
    }
}
