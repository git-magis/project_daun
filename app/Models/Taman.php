<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taman extends Model
{
    use HasFactory;

    protected $table = 'tamans';

    protected $fillable = [
        'nama',
        'latitude',
        'longitude',
        'kode',
    ];
}
