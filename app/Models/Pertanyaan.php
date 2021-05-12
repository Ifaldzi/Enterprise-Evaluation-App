<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = [
        'pertanyaan'
    ];

    public function tipeEvaluasi()
    {
        return $this->belongsTo(TipeEvaluasi::class);
    }

    public function struktur()
    {
        return $this->belongsTo(Struktur::class);
    }
}
