<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribut extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'atributs'; // Explicitly define the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entity_id',
        'entity_type',
        'attribute_name',
        'attribute_value',
    ];

    public function entity()
    {
        return $this->morphTo();
    }

    public function jenisPohon()
    {
        return $this->belongsTo(JenisPohon::class, 'entity_id');
    }

    public function jenisBunga()
    {
        return $this->belongsTo(JenisBunga::class, 'entity_id');
    }
}
