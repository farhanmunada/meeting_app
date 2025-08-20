<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rapat extends Model
{
    use HasFactory;

    protected $table = 'rapat';
    protected $fillable = [
        'judul',
        'agenda',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'ruang_id',
        'penyelenggara'
    ];

    // Cast tanggal dan waktu agar bisa pakai format() di view
    protected $casts = [
        'tanggal' => 'date',               // otomatis Carbon
        'waktu_mulai' => 'datetime:H:i',   // optional, jika mau format waktu
        'waktu_selesai' => 'datetime:H:i',
    ];

    // Relasi: rapat terkait dengan satu ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    // Relasi: rapat bisa memiliki banyak absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
