<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil';

    protected $fillable = ['keterangan', 'score_fungsionalitas', 'score_efektivitas'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
