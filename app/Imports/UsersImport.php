<?php

namespace App\Imports;

use App\Materia;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class UsersImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        // Validar si la fila contiene valores vacíos antes de continuar
        if (empty(array_filter($row))) {
            return null; // Ignorar filas vacías
        }
        print_r($row); // Print the array for debugging

        return new Materia([
            'idcarrera' => $row['idcarrera'],
            'codigo' => $row['codigo'],
            'materia' => $row['materia'],
        ]);
    }
}
