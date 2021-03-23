<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $increments = false;

    protected $fillable = ['nim', 'nama', 'kelas', 'jurusan', 'no_handphone', 'email', 'tanggal_lahir'];
}
