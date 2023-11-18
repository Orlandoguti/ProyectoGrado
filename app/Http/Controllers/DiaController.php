<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dia;

class DiaController extends Controller
{
    public function index()
    {
        $dias = Dia::all();
        return ['dias' => $dias];
    }
}