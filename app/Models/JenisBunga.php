<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBunga extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenisbungas'; // Explicitly define the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_jenis_bunga',
        'jumlah',
        'nama_ilmiah',
        'deskripsi',
        'gambar_bunga',
    ];

    public function bungas()
    {
        return $this->hasMany(Bunga::class, 'jenisb_id');
    }

    public function atributs()
    {
        return $this->hasMany(Atribut::class, 'entity_id')->where('entity_type', 'bunga');
    }
}
