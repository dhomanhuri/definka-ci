<?php

namespace App\Imports;

use App\Models\Alumni;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Alumni([
            'name'     => $row['nama'],
            'nim'    => $row['nim'], 
            'angkatan'    => $row['angkatan'], 
            'prodi'    => $row['prodi'], 
            'telepon'    => $row['telepon'], 
            'jenis_kelamin'    => $row['jenis_kelamin'], 
            'pekerjaan'    => $row['pekerjaan'], 
            'tempat_kerja'    => $row['tempat_kerja'], 
        ]);
    }
}
