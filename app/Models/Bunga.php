<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunga extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_bunga',
        'jenisb_id',
        'lokasib_id',
        'gambar_bunga',
    ];

    public function jenisBunga()
    {
        return $this->belongsTo(JenisBunga::class, 'jenisb_id', 'id');
    }

}
