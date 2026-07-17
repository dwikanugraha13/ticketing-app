<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nama_lokasi',
        'aktif',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
