<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::all();
        return ['periodos' => $periodos];
    }
}