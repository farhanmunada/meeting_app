<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapat;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua rapat yang belum selesai / upcoming
        $rapat = Rapat::orderBy('tanggal', 'asc')->get();

        return view('welcome', compact('rapat'));
    }
}
