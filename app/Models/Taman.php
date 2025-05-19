<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tamans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'latitude',
        'longitude',
        'gambar',
    ];

    public function pohons()
    {
        return $this->hasMany(Pohon::class, 'lokasi_id');
    }

    public function bungas()
    {
        return $this->hasMany(Bunga::class, 'lokasib_id');
    }

    public function jenisPohon()
    {
        return $this->hasManyThrough(JenisPohon::class, Pohon::class, 'lokasi_id', 'id', 'id', 'jenis_id');
    }

    public function jenisBunga()
    {
        return $this->hasManyThrough(JenisBunga::class, Bunga::class, 'lokasib_id', 'id', 'id', 'jenisb_id');
    }

}
