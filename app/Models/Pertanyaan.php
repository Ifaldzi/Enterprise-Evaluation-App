<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = [
        'pertanyaan',
        'struktur_id',
        'tipe_evaluasi_id'
    ];

    public function tipeEvaluasi()
    {
        return $this->belongsTo(TipeEvaluasi::class);
    }

    public function struktur()
    {
        return $this->belongsTo(Struktur::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->as('jawaban')
            ->withTimestamps()
            ->withPivot('jawaban');
    }
}
