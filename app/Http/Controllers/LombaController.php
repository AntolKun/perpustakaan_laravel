<?php

namespace App\Http\Controllers;

use App\Models\Lomba;

class LombaController extends Controller
{
  public function index()
  { 
    $lombas = Lomba::all();
    return view('Lomba', compact('lombas'));
  }

  public function detail($id)
  {
    $lomba = Lomba::findOrFail($id);

    return view('DetailLomba', compact('lomba'));
  }
}
