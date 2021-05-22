<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeEvaluasi extends Model
{
    protected $table = 'tipe_evaluasi';

    protected $fillable = [
        'nama_evaluasi'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
