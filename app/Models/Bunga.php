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
        'kode_unik',
    ];

    // protected static function boost()
    // {
    //     parent::boot();

    //     static::creating(function ($bunga) {
    //         $bunga->kode_unik = self::generateUniqueCode($bunga, $counters);
    //     });

    //     static::updating(function ($bunga) {
    //         $bunga->kode_unik = self::generateUniqueCode($bunga, $counters);
    //     });
    // }

    public static function generateUniqueCode($bunga, &$counters)
    {
        $key = $bunga->jenisb_id . '-' . $bunga->lokasib_id;

        if (!isset($counters[$key])) {
            $counters[$key] = 1;
        }

        $type = 'Flo'; // Flower
        $speciesCode = strtoupper(substr($bunga->jenisBunga->nama_jenis_bunga, 0, 4)); // First 4 letters of species
        $gardenCode = strtoupper(substr($bunga->taman->nama, -1)); // Last letter of garden name

        $uniqueCode = sprintf('%02d/%s/%s/%s', $counters[$key], $type, $speciesCode, $gardenCode);

        // dump([
        //     'unique_code' => $uniqueCode,
        //     'updated_counters' => $counters
        // ]);

        $counters[$key]++;

        return $uniqueCode;

    }

    public function jenisBunga()
    {
        return $this->belongsTo(JenisBunga::class, 'jenisb_id', 'id');
    }

    public function taman()
    {
        return $this->belongsTo(Taman::class, 'lokasib_id', 'id');
    }

}
