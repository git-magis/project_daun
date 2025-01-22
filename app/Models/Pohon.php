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
        'kode_unik',
    ];

    // protected static function boost()
    // {
    //     parent::boot();

    //     static::creating(function ($pohon) {
    //         $pohon->loadMissing('jenisPohon', 'taman');
    //         $pohon->kode_unik = self::generateUniqueCode($pohon, $counters);
    //     });

    //     static::updating(function ($pohon) {
    //         $pohon->loadMissing('jenisPohon', 'taman');
    //         $pohon->kode_unik = self::generateUniqueCode($pohon, $counters);
    //     });
    // }

    public static function generateUniqueCode($pohon, &$counters)
    {
        $key = $pohon->jenis_id . '-' . $pohon->lokasi_id; // Unique key for garden-species combo

        // Initialize the counter for this combination if not already set
        if (!isset($counters[$key])) {
            $counters[$key] = 1;
        }                                               

        $type = 'Tre'; // Tree
        $speciesCode = strtoupper(substr($pohon->jenisPohon->nama_jenis_pohon, 0, 4)); // First 4 letters of species
        $gardenCode = strtoupper(substr($pohon->taman->nama, -1)); // Last letter of garden name

        $uniqueCode = sprintf('%02d/%s/%s/%s', $counters[$key], $type, $speciesCode, $gardenCode);

        // dump([
        //     'unique_code' => $uniqueCode,
        //     'updated_counters' => $counters
        // ]);

        $counters[$key]++;

        return $uniqueCode;

    }

    public function jenisPohon()
    {
        return $this->belongsTo(JenisPohon::class, 'jenis_id', 'id');
    }

    public function taman()
    {
        return $this->belongsTo(Taman::class, 'lokasi_id', 'id');
    }
}
