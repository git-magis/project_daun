<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pohon extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        'tanggal_tanam',
        'user_id',
    ];

    public static function generateUniqueCode($pohon, &$counters)
    {
        $key = $pohon->jenis_id . '-' . $pohon->lokasi_id; // Unique key for garden-species combo

        // Initialize the counter for this combination if not already set
        if (!isset($counters[$key])) {
            $counters[$key] = 1;
        }                                               

        $type = 'Tre'; // Tree
        $wordsToRemove = ['Bambu', 'Pohon', 'Bukit', 'Taman']; // Add more words as needed
        $filteredName = str_replace($wordsToRemove, '', $pohon->jenisPohon->nama_jenis_pohon);
        $speciesCode = strtoupper(substr(str_replace(' ', '', $filteredName), 0, 4));
        $tamanFiltered = str_replace($wordsToRemove, '', $pohon->taman->nama);
        $gardenCode = strtoupper(substr(str_replace(' ', '', $tamanFiltered), 0, 4)); // First 4 letters of garden name

        $uniqueCode = sprintf('%02d/%s/%s-%s', $counters[$key], $type, $speciesCode, $gardenCode);

        $counters[$key]++;

        return $uniqueCode;

    }

    public function getUmurAttribute()
    {
        if (!$this->tanggal_tanam) return null;

        $diff = Carbon::parse($this->tanggal_tanam)->diff(Carbon::now());
        return $diff->y > 0 ? "{$diff->y} thn." : "{$diff->m} bln.";
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y | H:i');
    }

    public function jenisPohon()
    {
        return $this->belongsTo(JenisPohon::class, 'jenis_id', 'id');
    }

    public function taman()
    {
        return $this->belongsTo(Taman::class, 'lokasi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
