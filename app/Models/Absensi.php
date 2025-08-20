<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = [
        'rapat_id',
        'nama',
        'instansi',
        'jabatan',
        'kontak',
        'waktu_absen'
    ];

    // Relasi: absensi milik satu rapat
    public function rapat()
    {
        return $this->belongsTo(Rapat::class);
    }
}
