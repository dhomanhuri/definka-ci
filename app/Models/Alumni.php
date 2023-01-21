<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $table = 'alumnis';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'nim', 'angkatan', 'prodi', 'telepon', 'jenis_kelamin', 'pekerjaan', 'tempat_kerja'];
}
