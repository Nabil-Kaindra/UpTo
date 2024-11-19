<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\auth;

class Photo extends Model 
{
    protected $primaryKey='fotoID';
    protected $fillable = [
    'judulFoto',
    'tanggalUnggah',
    'lokasiFile',
    'albumID',
    'userID',
];

    public function album() {
        return $this->belongsTo(Album::class, 'albumID');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userID');
    }
}