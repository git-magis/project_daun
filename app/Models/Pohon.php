<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pohon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pohon',
        'jenis_id',
        'lokasi_id',
        'gambar_pohon',
    ];

    public function jenisPohon()
    {
        return $this->belongsTo(JenisPohon::class, 'jenis_id', 'id');
    }

    public function taman()
    {
        return $this->belongsTo(Taman::class, 'lokasi_id', 'id');
    }
}
