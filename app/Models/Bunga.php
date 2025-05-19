<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bunga extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        'user_id',
    ];

    public static function generateUniqueCode($bunga, &$counters)
    {
        $key = $bunga->jenisb_id . '-' . $bunga->lokasib_id;

        if (!isset($counters[$key])) {
            $counters[$key] = 1;
        }

        $type = 'Flo'; // Flower
        $wordsToRemove = ['Bunga', 'Bukit', 'Taman']; // Add more words as needed
        $filteredName = str_replace($wordsToRemove, '', $bunga->jenisBunga->nama_jenis_bunga);
        $speciesCode = strtoupper(substr(str_replace(' ', '', $filteredName), 0, 4));
        $tamanFiltered = str_replace($wordsToRemove, '', $bunga->taman->nama);
        $gardenCode = strtoupper(substr(str_replace(' ', '', $tamanFiltered), 0, 4)); // First 4 letters of garden name

        $uniqueCode = sprintf('%02d/%s/%s-%s', $counters[$key], $type, $speciesCode, $gardenCode);

        $counters[$key]++;

        return $uniqueCode;

    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y | H:i');
    }

    public function jenisBunga()
    {
        return $this->belongsTo(JenisBunga::class, 'jenisb_id', 'id');
    }

    public function taman()
    {
        return $this->belongsTo(Taman::class, 'lokasib_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

}
