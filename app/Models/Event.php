<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'lokasi',
        'gambar',
        'tanggal_waktu',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------
    */

    public function tikets()
    {
        return $this->hasMany(Tiket::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*
    |--------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------
    */

    /**
     * Status event berdasarkan tanggal_waktu:
     * Upcoming, Ongoing (dianggap berlangsung selama 3 jam), atau Completed.
     */
    public function getStatusAttribute()
    {
        if (!$this->tanggal_waktu) {
            return 'Upcoming';
        }

        $now = now();
        $start = $this->tanggal_waktu;
        $end = $start->copy()->addHours(3);

        if ($now->lt($start)) {
            return 'Upcoming';
        }

        if ($now->between($start, $end)) {
            return 'Ongoing';
        }

        return 'Completed';
    }

    /**
     * URL gambar event yang aman: URL eksternal valid, file storage, atau default.
     */
    public function getImageUrlAttribute()
    {
        $gambar = $this->gambar;

        if ($gambar && filter_var($gambar, FILTER_VALIDATE_URL)) {
            return $gambar;
        }

        $imageName = (!empty($gambar) && file_exists(public_path('storage/' . $gambar)))
            ? $gambar
            : 'konser.jpg';

        return asset('storage/' . $imageName);
    }

    /*
    |--------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------
    */

    /**
     * Apakah event ini sudah memiliki penjualan (order)?
     */
    public function hasSales()
    {
        return $this->orders()->exists();
    }

    /*
    |--------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------
    */

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_waktu', '>', now());
    }

    public function scopeOngoing($query)
    {
        $now = now();

        return $query->where('tanggal_waktu', '<=', $now)
            ->where('tanggal_waktu', '>=', $now->copy()->subHours(3));
    }

    public function scopeCompleted($query)
    {
        return $query->where('tanggal_waktu', '<', now()->subHours(3));
    }
}
