<?php

namespace App\Imports;

use App\Oser;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Oser([
            'fecha'=> Carbon::parse($row['fecha']),
            'ambiente_id' => $row['aula'],
            'materia'    => $row['materia'],
            'semestre' => $row['s'],
            'paralelo'    => $row['p'],
            'docente' => $row['docente'],
            'hora_inicio'  => Date::excelToDateTimeObject($row['inicio']),
            'hora_fin'  => Date::excelToDateTimeObject($row['fin']),
            'carrera' => $row['carrera'],
        ]);
    }
}