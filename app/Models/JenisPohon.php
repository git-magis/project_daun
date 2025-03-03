<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPohon extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenispohons'; // Explicitly define the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_jenis_pohon',
        'jumlah',
        'nama_ilmiah',
        'deskripsi',
        'gambar_pohon',
    ];

    public function pohons()
    {
        return $this->hasMany(Pohon::class, 'jenis_id');
    }

    public function atributs()
    {
        return $this->hasMany(Atribut::class, 'entity_id')->where('entity_type', 'pohon');
    }
}
