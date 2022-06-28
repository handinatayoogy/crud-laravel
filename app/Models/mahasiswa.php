<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['foto','nim', 'nama', 'tanggal_lahir', 'ipk'];
}
