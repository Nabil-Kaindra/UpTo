<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model{
    protected $primaryKey = 'albumID';
    protected $fillable = [
        'namaAlbum',
        'deskripsi',
        'waktu',
        'lokasi',
        'userID',
        'tanggalDibuat'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userID');
    }

    public function photos() {
        return $this->hasMany(Photo::class, 'albumID');
    }
}
