<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model

 {   use HasFactory;
    protected $table="jurusan";
    protected $primarykey="id_jurusan";
    protected $fillable = ['Nama_Jurusan'];
}