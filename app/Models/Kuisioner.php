<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    use HasFactory;
    protected $table = 'questionnaires';
    protected $primaryKey = 'id';
    protected $fillable = ['judul_kuisioner', 'tanggal_kirim', 'status_kuisioner'];
}
